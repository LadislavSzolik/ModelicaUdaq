#!/usr/bin/python
# coding=UTF-8

import os,signal, sys, psutil,time
import cgitb; cgitb.enable()
import vFunk

print "Content-type: text/html\n"

PID = vFunk.foundProc("python","server.py")
if PID is 0:
  sys.exit(-1)
  
#print "zastavitUdaq.py vymazanie\n"
os.kill(PID, signal.SIGHUP)

sys.exit(0)

