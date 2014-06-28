#!/usr/bin/python
# coding=UTF-8  

import os, signal, socket, psutil,sys
from subprocess import Popen
import cgitb; cgitb.enable()

print "Content-Type: text/plain;charset=utf-8"
print
PROCNAME = "python"
FILENAME = "pyReady.py"
PID = 0
inf = False
for proc in psutil.process_iter():	
	if proc.name == PROCNAME:
		if str(proc).find(FILENAME) is not -1:
			PID =  proc.pid

def convertStr(s):
 	try:
 		ret = int(s)
 	except ValueError:
 		ret = float(s)
 	return ret

if PID is 0:
	print """
	var ok = false;
	"""	
else:
	HOST = '127.0.0.1'
	PORT = 10666
	s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
	try:
	    s.bind((HOST, PORT))
	    s.listen(1)
	except Exception, e:
	    print """		
		var ok = false;
		"""
	PROCNAME = "python"
	FILENAME = "server.py"
	PID = 0
	for proc in psutil.process_iter():	
		if proc.name == PROCNAME:
			if str(proc).find(FILENAME) is not -1:
				PID =  proc.pid

	os.kill(int(PID), signal.SIGINT)
	conn, addr = s.accept()
	output = ""
	while 1:
	    data = conn.recv(1024)
	    if not data:
	        break
	    else:
	        output += str(data)
	conn.close()
	
	casGraf = 0
	output = output.split("#")
	print str(len(output))
	if len(output) is not 8 and len(output) is not 7:
		sys.exit(-1)
	if len(output) is 8:
		inf = True
	tempGraf = str(output[0])
	ftempGraf = str(output[1])
	lightGraf = str(output[2])
	flightGraf = str(output[3])
	fan_outGraf = str(output[4])
	fanrpmGraf = str(output[5])
	ref_inputGraf = str(output[6])
	try:
		cas1 = tempGraf.split(',')
		cas1 = cas1[0].replace('[','')
		cas1 = convertStr(cas1)
		casGraf = cas1 - (cas1%10)
		if float(cas1) > float(casGraf+10):
			casGraf = casGraf + 10	
	except:
		cas1 = 0
		casGraf = 0
		
	if inf is True:
		print """var optGraf = {legend:{container:$('.legendContainer')},lines: { show: true }, grid: { backgroundColor: { colors: ["#fff", "#eee"] }}};"""
	else:
		print """var optGraf = {legend:{container:$('.legendContainer')},lines: { show: true }, grid: { backgroundColor: { colors: ["#fff", "#eee"] }}  , xaxis: {min: """+str(casGraf)+""",max:"""+str(casGraf+10)+"""}};"""
	
	print """
	graf1Data = ["""+tempGraf+"""];
	graf2Data = ["""+ftempGraf+"""];
	graf3Data = ["""+lightGraf+"""];
	graf4Data = ["""+flightGraf+"""];
	graf5Data = ["""+fan_outGraf+"""];
	graf6Data = ["""+fanrpmGraf+"""];
	graf7Data = ["""+ref_inputGraf+"""];
	var ok = true;
	"""
