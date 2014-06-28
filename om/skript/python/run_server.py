#!/usr/bin/python
# coding=UTF-8

#IMPORT
import cgi, os, psutil, sys, _GlobalIDL, subprocess, re ,getpass, time, os, shutil, vFunk
import cgitb; cgitb.enable()
from subprocess import Popen, PIPE, STDOUT
from tempfile import mkstemp
from os import remove, close
from omniORB import CORBA
import logging
import MySQLdb
import time

#LOG_FILENAME = 'spustiUdaq.log'
#logging.basicConfig(filename=LOG_FILENAME, level = logging.DEBUG, filemode='w')

if vFunk.foundProc("python","server.py") is not 0:
  sys.exit(-1)
  

#DEKLARACIA
udaqModel = "UdaqCont"
udaqInitTxt = "UdaqCont_init.txt"
tempdir = "/tmp/"	
_parsPy = []
if str(getpass.getuser()) == 'www-data':
	omc_objid = tempdir + "openmodelica.nobody.objid"
else:
	omc_objid = tempdir + "openmodelica."+str(getpass.getuser())+".objid"

vFunk.deleteFile(omc_objid)
vFunk.deleteFile(udaqModel)
vFunk.deleteFile(udaqInitTxt)


print "Content-Type: text/plain;charset=utf-8"
print
#
# ziskanie parametre z formulara
#

def sqltoTime(sqlTime):
	try:
		cas = int(time.mktime(time.strptime(sqlTime,"%Y-%m-%d %H:%M:%S")))
	except:
		cas = 0
	return cas


form = cgi.FieldStorage()

if form.has_key('intensity'):
	_int = form['intensity'].value
else:
	_int = "30"

if form.has_key('ref'):
	_ref = form['ref'].value
else:
	_ref  = "20"

if form.has_key('fun'):
	_fun = form['fun'].value
else:
	_fun = "2"

if form.has_key('led'):
	_led = form['led'].value
else:
	_led = "5"

if form.has_key('sample'):
	_sample = form['sample'].value
else:
	_sample = "100"

if form.has_key('contStr'):
	_regulator = form['contStr'].value
else:
	_regulator = """model Controller
	parameter Real Ref = %s;
  parameter Real K = 8;
  parameter Real Ti = 32;
  parameter Real Td =  0.1625;
  udaqOut cIn;
  udaqIn  cOut;
  Real error ;
  Real x;
  Real y;
equation
	error =  Ref - cIn.value;	
	der(x) = error/Ti;	
	y = Td*der(error);
	cOut.value = K*(error +x +y);
end Controller;""" % (_ref )

_extParams = ""
if form.has_key('aktualPar'):
	_extParams = "("
	_params = form['aktualPar'].value
	_params = _params.split(",")
	for par in range(len(_params)):
		if form.has_key('par'+_params[par]):
			if par == len(_params)-1:
				_extParams = _extParams + form['par'+_params[par]].value
			else:
				_extParams = _extParams + form['par'+_params[par]].value + ","
	_extParams = _extParams + ")"

#######################################################
if form.has_key('contName'):
	_nazovReg = form['contName'].value
else:
	_nazovReg = "Controller"


if form.has_key('nickname'):
	userNick = form['nickname'].value
else:
	userNick = "unkown"
	
if form.has_key('user_id'):
	user_id = form['user_id'].value
else:
	user_id = "20"

if form.has_key('contId'):
	contID = form['contId'].value
else:
	contID = "PID regulator"
	
if form.has_key('onlyStep'):
	onlyStep = form['onlyStep'].value
else:
	onlyStep = "0"

aktualTime = int(time.time())
reserved = False

conn = MySQLdb.connect (host = "127.0.0.1",
	user = "root",
	passwd = "syoliklaci",
	db = "OMdatabase",
	charset = "utf8", use_unicode = True)

if form.has_key('lang'):
	lang = form['lang'].value
else:
	lang = "SK"
cursor = conn.cursor (MySQLdb.cursors.DictCursor)
cursor.execute("""SELECT * FROM  lang WHERE id=114""")
row = cursor.fetchone()
errorMsg1 = row["content"+lang]

cursor.execute("""SELECT * FROM  lang WHERE id=115""")
row = cursor.fetchone()
errorMsg2 = row["content"+lang]

cursor.execute("""SELECT * FROM reservations WHERE user_id = %s""", (user_id))

while (1):
	row = cursor.fetchone()
	if row == None:
		break
	if sqltoTime(str(row["time_from"]))<= aktualTime and aktualTime < (sqltoTime(str(row["time_to"]))-60):
		timeUntil = sqltoTime(str(row["time_to"])) - aktualTime
		reserved = True

if reserved is False or timeUntil <= 0:
	print """
			var response = confirm('"""+errorMsg1.encode('utf8')+"""');
			if(response){
				window.location = "index.php?page=10";
			}else {
				window.location = "index.php?page=2";
			}
			"""
	sys.exit(-1)


new_sample = 1000/int(_sample)

if new_sample < 1:
	new_sample = 1

if onlyStep is "1":
	contID = "-2"
	_nazovReg = "Controller"
	_regulator = """model Controller
  parameter Real Ref = %s;
  parameter Real Cor = 80/5;
  udaqOut cIn;
  udaqIn  cOut;
  Real error;
equation
	error =  cIn.value;
	cOut.value = Ref*Cor ;
end Controller;""" % ( _int)

mainModel = "model UdaqCont "+_nazovReg+" control"+_extParams+";  Udaq udaq(fun="+_fun+",led="+_led+"); equation connect(udaq.uIn, control.cOut);connect(udaq.uOut, control.cIn);end UdaqCont;"

####################################################################################################################	
zoznam = ["loadFile(\"uDAQbaseModel.mo\")",_regulator, mainModel,"buildModel(UdaqCont,numberOfIntervals="+str(new_sample)+")"]
cmdCount = 4
####################################################################################################################
omc,child = vFunk.runOM(omc_objid)
controlArr = []
isValid = True
if omc is not 0 or child is not 0:
	for jeden in zoznam:
		if vFunk.cmdFilter(jeden):
			try:
				out = omc.sendExpression(jeden)
				#print out
				if out.find("Error") is not -1 or out.find("{\"\",\"\"}") is not -1:
					isValid = False
					break
				controlArr.append(1)
				#logging.debug('prikaz '+jeden+' vystup: '+omc.sendExpression(jeden)) 
			except:
				break
				#logging.debug('neposlany prikaz '+jeden)	
	if len(controlArr) < cmdCount or isValid is False:
		print "alert('"+errorMsg2.encode('utf8')+"');window.location.reload();"
		child.terminate()
		sys.exit(-1)
	else:
		child.terminate()
		vFunk.waitForFile(udaqModel)
		vFunk.waitForFile(udaqInitTxt)
else:
	os.popen("kill -9 "+str(os.getpid()))


STDOUT2 = open("stdout2","w")
if form.has_key('timeLimit'):
	_limit = form['timeLimit'].value
else:
	_limit = str(timeUntil)
	
if _limit.find("inf") is not -1:
	_limit = str(timeUntil)
if int(_limit) > timeUntil:
	_limit = str(timeUntil)


outSample =str(float(_sample)/1000)
child = Popen(["python", "./server.py",userNick, contID, _regulator,_limit,onlyStep,outSample], shell=False,stdout=STDOUT2)