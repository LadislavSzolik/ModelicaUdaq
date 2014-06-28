#!/usr/bin/python
# coding=UTF-8
import cgitb; cgitb.enable()
import os, psutil, sys, _GlobalIDL, re, time, subprocess
from subprocess import Popen, PIPE, STDOUT
from tempfile import mkstemp
from shutil import move
from os import remove, close
from omniORB import CORBA
#-------------------------------------------------------------------------------------------------#

def cmdFilter(cmd): #cmdFilter
	if re.search('system\ *\(',cmd) != None or (re.search('cd\ *\(',cmd) != None):
		return False
	else:
		return	True
#----------------------------CAKAJ NA SUBOR---------------------#
def waitForFile(inFile): #cakajNaSubor
	TIMEOUT = 20
	COUNTER = 0
	while not os.path.exists(inFile):
		if COUNTER == TIMEOUT:
			#print "Nepodarilo sa spustiť "+subor+", TIMEOUT!\n"
			sys.exit(-1)
		else:
			time.sleep(0.1)
			COUNTER = COUNTER +1
			#logfile.write("spustenie.. "+subor+"\n"
	#logfile.write("spustene "+subor+"\n")

#----------------------------VYMAZANIE SUBOROV---------------------#
def deleteFile(inFile):  #deleteFile
	if os.path.exists(inFile):
		try:
			remove(inFile)
			return 0
		except:
			return 1
	else:
		return 0
#----------------------------NAJDI PROCES-------------------------#
def foundProc(PROCNAME,FILENAME): #foundProc
	PID = 0
	for i in range(0,20):
		for proc in psutil.process_iter():	
			if proc.name == PROCNAME:				
				if str(proc).find(FILENAME) is not -1:					
					PID =  proc.pid
					return PID
		time.sleep(0.1)

	return PID		
#----------------------------runOM-------------------------#
def runOM(omc_objid): #runOM
	omc = 0
	child = 0
	os.putenv('QTHOME', '/usr/')
	os.putenv('OPENMODELICAHOME', '/usr/')
	os.putenv('OPENMODELICALIBRARY', '/usr/lib/omlibrary/msl31/:/usr/lib/omlibrary/common/')
	os.putenv('LD_LIBRARY_PATH', '/usr/lib')
	child = Popen(["/usr/bin/omc","+d=interactiveCorba"], shell=False, stdin=PIPE ,stdout=PIPE)
	waitForFile(omc_objid)
	orb = CORBA.ORB_init([], CORBA.ORB_ID)
	objid_file = os.open(omc_objid, os.O_RDWR)
	ior = os.read(objid_file, 500)
	mico_obj = orb.resolve_initial_references("RootPOA")
	obj = orb.string_to_object(ior)
	omc = obj._narrow(_GlobalIDL.OmcCommunication)
	return omc, child
#----------------------------convertStr-------------------------#
def convertStr(s): #
 	try:
 		ret = int(s)
 	except ValueError:
 		ret = float(s)
 	return ret