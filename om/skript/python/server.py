#!/usr/bin/python
# coding=UTF-8

from subprocess import Popen, PIPE, STDOUT
from multiprocessing import Process, Queue
from multiprocessing.connection import Client
import socket,time, os, signal, sys, threading,psutil, math
import usb.core
import usb.util
import vFunk
import MySQLdb
import random


temp = []
ftemp = []
light = []
flight = []
fan_out = []
fanrpm = []
ref_input = []
casM = []

casMGraf = []
tempGraf = []
ftempGraf = []
lightGraf = []
flightGraf = []
fan_outGraf = []
fanrpmGraf = []
ref_inputGraf = []


casPomoc = 0

t1,t2,t3 = 0,0,0
DONE = True
prvy = 0	
newID = 0

eCont = False
eReq = True

timeLimit = sys.argv[4]
onlyStep = sys.argv[5]
outSample = sys.argv[6]

actualTime = "0"
changeGlobal = False
toChange = "udaq.fun=0:udaq.led=0"
timeToDo = 0

_newTime = 0
############################################################################################################
# transfer server
class TransferThread(threading.Thread):
	def __init__(self):
		super(threading.Thread, self).__init__()
		threading.Thread.__init__(self)

	def transformData(self,data):
		try:
			data = data.split("#")
			time1 = data[1]
			for data1 in data:
				if data1.find("udaq") is not -1:
					data2 = data1.split(":")
					help, temp1 = data2[0].split("=")
					help, ftemp1 = data2[1].split("=")
					help, light1 = data2[2].split("=")
					help, flight1 = data2[3].split("=")
					help, fan_out1 = data2[4].split("=")
					help, fanrpm1 = data2[5].split("=")
				if data1.find("control") is not -1:
					help, ref_input1 = data1.split("=")
			return time1,temp1, ftemp1, light1, flight1, fan_out1, fanrpm1, ref_input1
		except:
			return 0,0,0,0,0,0,0,0
			
	def run(self):
		global t2,connT, prvy,  casPomoc, onlyStep,timeLimit, actualTime,s, changeGlobal, _newTime
		global casM, temp, ftemp, light, flight, fan_out, fanrpm, ref_input, toChange, timeToDo
		global casMGraf,tempGraf,ftempGraf,lightGraf,flightGraf,fan_outGraf,fanrpmGraf,ref_inputGraf
		t2 = os.getpid()		
		HOST = '127.0.0.1'
		PORT = 10502
		s2 = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
		s2.bind((HOST, PORT))
		s2.listen(1)
		connT, addr = s2.accept()
		int1 = 0
		tep1 = 0
		cas = 0
		changed = False
		_newCounter = 0
		while 1:	
			data = connT.recv(1024)
			if not data: 
				break
			
			out1,out2,out3,out4,out5,out6,out7,out8 = self.transformData(data)
			actualTime = out1
			out1 = str(_newTime)
			if changeGlobal is False:
				#print data
				#if actualTime is "15" and _newCounter < 3:
				#	s.send("changevalue#4#18#"+toChange+"#end")
				#	_newCounter = _newCounter +1
				
				#	time.sleep(0.6)
				#	print "##############################"
				#	print "cas na zmenu"+str((float(out1)-0.01))
				#	print "##############################"
				#	s.send("pause#3#end")
					#s.send("changetime#5#"+str(timeToDo)+"#end")
				#	toChange = "null"
				#	time.sleep(1)
					
					#s.send("start#6#end")
					
				if float(out1) >= float(timeLimit):
					os.kill(os.getpid(), signal.SIGHUP)
					
				if float(out1) >= float(casPomoc+10):
					casPomoc = casPomoc+10
					casMGraf = []
					tempGraf = []
					ftempGraf = []
					lightGraf = []
					flightGraf = []
					fan_outGraf = []
					fanrpmGraf = []
					ref_inputGraf = []
	
				casMGraf.append(str(out1))
				tempGraf.append(str(out2))
				ftempGraf.append(str(out3))
				lightGraf.append(str(out4))
				flightGraf.append(str(out5))
				fan_outGraf.append(str(out6))
				fanrpmGraf.append(str(out7))
				ref_inputGraf.append(str(out8))
	
				casM.append(out1)
				temp.append(out2)
				ftemp.append(out3)
				light.append(out4)
				flight.append(out5)
				fan_out.append(out6)
				fanrpm.append(out7)
				ref_input.append(out8)
			else:
				print "wait"

		connT.close()
############################################################################################################
# control server		
class ControlThread(threading.Thread):
	def run(self):
		global t3, connC, DONE
		#ControlFile = open("chageOut","a")
		t3 = os.getpid()
		HOST = '127.0.0.1'
		PORT = 10500
		s3 = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
		s3.bind((HOST, PORT))
		s3.listen(1)
		connC, addr = s3.accept()	
		while 1:	
			data = connC.recv(1024)
			if not data: 
				break
			#print ">>control "+data+"\n"
			#ControlFile.write(">"+str(data)+"\n")
			DONE = True
		connC.close()

############################################################################################################
# sendData		
class SendThread(threading.Thread):
	def run(self):
		global casMGraf,tempGraf,ftempGraf,lightGraf,flightGraf,fan_outGraf,fanrpmGraf,ref_inputGraf
		global casM, temp, ftemp, light, flight, fan_out, fanrpm, ref_input
		global eCont,eReq
		HOST1 = '127.0.0.1'
		PORT1 = 10666
		#while 1:
		try:
			#print "send: eCont "+str(eCont)
			sendS = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
			sendS.connect((HOST1,PORT1))
			#print "connecto to sendData...success"
			if eCont is False:
				newArr1 = casMGraf
				newArr2 = tempGraf
				newArr3 = ftempGraf
				newArr4 = lightGraf
				newArr5 = flightGraf
				newArr6 = fan_outGraf
				newArr7 = fanrpmGraf
				newArr8 = ref_inputGraf
			else:				
				newArr1 = casM
				newArr2 = temp
				newArr3 = ftemp
				newArr4 = light
				newArr5 = flight
				newArr6 = fan_out
				newArr7 = fanrpm
				newArr8 = ref_input
			
			if len(newArr1) >1 :
				for i in range(0,len(newArr2)-2):
					intValue = str("["+str(newArr1[i])+","+str(newArr2[i])+"],")
					sendS.send(intValue)
				sendS.send(str("["+str(newArr1[len(newArr2)-1])+","+str(newArr2[len(newArr2)-1])+"]"))

				sendS.send("#")

				for j in range(0,len(newArr3)-2):
					inVal = str("["+str(newArr1[j])+","+str(newArr3[j])+"],")
					sendS.send(inVal)
				sendS.send(str("["+str(newArr1[len(newArr3)-1])+","+str(newArr3[len(newArr3)-1])+"]"))
				
				sendS.send("#")
				
				for j in range(0,len(newArr4)-2):
					inVal = str("["+str(newArr1[j])+","+str(newArr4[j])+"],")
					sendS.send(inVal)
				sendS.send(str("["+str(newArr1[len(newArr4)-1])+","+str(newArr4[len(newArr4)-1])+"]"))
				
				sendS.send("#")
				
				for j in range(0,len(newArr5)-2):
					inVal = str("["+str(newArr1[j])+","+str(newArr5[j])+"],")
					sendS.send(inVal)
				sendS.send(str("["+str(newArr1[len(newArr5)-1])+","+str(newArr5[len(newArr5)-1])+"]"))
				
				sendS.send("#")
				
				for j in range(0,len(newArr6)-2):
					inVal = str("["+str(newArr1[j])+","+str(newArr6[j])+"],")
					sendS.send(inVal)
				sendS.send(str("["+str(newArr1[len(newArr6)-1])+","+str(newArr6[len(newArr6)-1])+"]"))
				
				sendS.send("#")
				
				for j in range(0,len(newArr7)-2):
					inVal = str("["+str(newArr1[j])+","+str(newArr7[j])+"],")
					sendS.send(inVal)
				sendS.send(str("["+str(newArr1[len(newArr7)-1])+","+str(newArr7[len(newArr7)-1])+"]"))
				
				sendS.send("#")
				
				for j in range(0,len(newArr8)-2):
					inVal = str("["+str(newArr1[j])+","+str(newArr8[j])+"],")
					sendS.send(inVal)
				sendS.send(str("["+str(newArr1[len(newArr8)-1])+","+str(newArr8[len(newArr8)-1])+"]"))
				
				if eCont is True:
					sendS.send("#")
					sendS.send("end")
			else:
				sendS.send(str("[0,0]"))
			sendS.close()
		except:
			sendS.send(str("[0,0]"))
			sendS.close()
			#time.sleep(1)
			#print "connecto to sendData"
			pass
		if eCont is True:
			eReq = False
############################################################################################################
class ChangeThread(threading.Thread):
	def run(self):
		global s, actualTime,changeGlobal,toChange,timeToDo
		address = ('127.0.0.1', 51234)
		while 1:
			try:
				conn = Client(address, authkey='passw')
				#tempTime = actualTime.replace(".","")
				timeToDo = float(actualTime)
				parametre = conn.recv_bytes()
				#print "time is "+str(timeToDo)
				#while timeToDo%21 is not 0:
				#	tempTime = actualTime.replace(".","")
				#	timeToDo = float(tempTime)
					
				changeGlobal = True
				toChange = parametre
				#s.send("pause#3#end")
				#time.sleep(1)
				#s.send("changetime#4#"+str(timeToDo+2.2)+"#end")

				#print "change started"
				s.send("changevalue#4#"+str(timeToDo)+"#"+toChange+"#end")
				time.sleep(0.6)
				#print "changed"

				#s.send("changetime#5#"+str(timeToDo+2.2)+"#end")
				#s.send("start#5#end")
				#s.send("changevalue#3#"+str(actualTime)+"#"+parametre+"#end")
				#time.sleep(0.5)
				#s.send("changevalue#3#Tn#"+parametre+"#end")
				conn.close()
				changeGlobal = False
			except:
				print "change error"
############################################################################################################
def exit(signum,frame):
	global connC, connT, udaqOM, s, t2, t3, intenzita, teplota, newID, conn, cursor, casM,pyReady,pyTimer
	global temp, ftemp, light, flight, fan_out, fanrpm, ref_input
	global eCont,eReq
	limiting = 0
	max_limit = 5
	try:
		s.send("shutdown#5#end")
		time.sleep(0.3)
		udaqOM.terminate()
		s.close()
	except:
		print "nepodarilo sa odstranit udaqOM\n"
	os.system("./uDAQ_init")
	try:
		connT.close()
		connC.close()
	except:
		print "Error: connT, connC"
		
	eCont = True
	print "kontrol"
	while eReq is True:
		time.sleep(1)
		print "hodnota eReq "+str(eReq)
		limiting = limiting +1
		if limiting == max_limit:
			print "limit vyprsal"
			break
	try:
		#pyTimer.terminate()
		pyReady.terminate()
	except:
		pass
	try:
		result_set = cursor.fetchall()
		cursor.execute("""
			UPDATE reports 
			SET temp=%s, ftemp=%s, light=%s, flight=%s, fan_out=%s, fanrpm=%s, time=%s, ref_input=%s, endTime=NOW() 
			WHERE ID =%s
		""",(str(temp),str(ftemp),str(light),str(flight),str(fan_out),str(fanrpm),str(casM),str(ref_input),newID))
		cursor.close()
		conn.commit()
		conn.close()
	except:
		pass
	os.popen("kill -9 "+str(os.getpid()))
############################################################################################################
def sendData(signum, frame):
	SendThread().start()
############################################################################################################
if __name__ == '__main__':	
	os.nice(1)
	os.popen("killall -9 UdaqCont")
	signal.signal(signal.SIGINT, sendData)
	signal.signal(signal.SIGHUP,exit)
	os.system("./uDAQ_init") #app napisane v C na nastavenie 0,0,0 na vstupy zdroj:CallCFromPython
	PORT = random.randrange(1024, 65535)
	try:
		udaqOM = Popen(["./UdaqCont","-interactive","-port", str(PORT)], shell=False, stderr = STDOUT)
	except:
		os.popen("kill -9 "+str(t2))
		os.popen("kill -9 "+str(t3))
		sys.exit(0)
	udCoPID = vFunk.foundProc("UdaqCont","UdaqCont")
	if udCoPID is 0:
		sys.exit(-1)
	HOST = '127.0.0.1'
	################################### report do DB ####################################
	try:
		conn = MySQLdb.connect (host = "127.0.0.1",
							user = "root",
							passwd = "syoliklaci",
							db = "OMdatabase")
		cursor = conn.cursor (MySQLdb.cursors.DictCursor)	
		cursor.execute ("""
		INSERT INTO reports (login, controllerId, usedController,  startTime) VALUES
		(%s, %s, %s, NOW())
		""",(sys.argv[1],sys.argv[2],sys.argv[3]))
		newID = cursor.lastrowid
	except:
		print "db error: used controller"
	###################################################################################
	s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
	
	try:
		s.connect((HOST,PORT))
	except socket.error, msg:
		print "s.connect error",msg
		udaqOM.terminate()
		os.system("./uDAQ_init")
		sys.exit(0)
	
	ControlThread().start()
	TransferThread().start()
	
	prikazy= ["start","setfilter#1#udaq.out1:udaq.out2:udaq.out3:udaq.out4:udaq.out5:udaq.out6#control.Ref#end","start#2#end"]
	Count = 0
	Max = 30
	for prikaz in prikazy:
		s.send(prikaz)
		while not DONE:
			time.sleep(0.1)
			Count = Count + 1
			if Count == Max:
				sys.exit(-1)	
		time.sleep(1)
		DONE = False
	ChangeThread().start()
	pyReady = Popen(["python","./pyReady.py"], shell=False)
	while 1:
		time.sleep(float(outSample))
		_newTime = _newTime + float(outSample)
		pass