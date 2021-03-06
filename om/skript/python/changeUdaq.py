#!/usr/bin/python
# coding=UTF-8
from subprocess import Popen, PIPE, STDOUT
from multiprocessing.connection import Listener
import cgitb; cgitb.enable()
import cgi,socket,time, psutil
import os
import signal
import sys
import usb.core
import usb.util
import vFunk

print "Content-type: text/html\n"

if vFunk.foundProc("python","server.py") is not 0:
	form = cgi.FieldStorage()
	if form.has_key('fun'):
		_fun = form['fun'].value
		_led = form['led'].value
	address = ('127.0.0.1', 51234)
	listener = Listener(address, authkey='passw')
	conn = listener.accept()

	toSend = ""

	if form.has_key('aktualPar'):
		_params = form['aktualPar'].value
		_params = _params.split(",")
		for par in _params:
			if form.has_key('par'+par):
				toSend = toSend+"control."+form['par'+par].value+":"
		toSend=toSend+"udaq.fun="+_fun+":udaq.led="+_led
	else:
		toSend ="udaq.fun=0:udaq.led=0"
	conn.send_bytes(toSend)
	conn.close()
	listener.close()