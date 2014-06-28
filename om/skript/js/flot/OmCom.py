#!/usr/bin/python

import os
from omniORB import CORBA
import _GlobalIDL
import time
import getpass
import re
import subprocess
from subprocess import PIPE
class OmCom:	
	
	def __init__ (self,novyObjid):
		self.novyObjid = novyObjid
		self.prikazyFile = self.novyObjid+".prikazy"
		os.putenv('QTHOME', '/usr/lib/omc/lib')
		os.putenv('OPENMODELICAHOME', '/usr/lib/omc')
		os.putenv('OPENMODELICALIBRARY', '/usr/share/omlibrary/modelicalib/')
		os.putenv('LD_LIBRARY_PATH', '/usr/lib')
		#self.child = os.popen2("/var/www/openmodelica/subproces.sh")	#stary prikaz	
		self.child = subprocess.Popen(["/usr/lib/omc/bin/omc","+d=interactiveCorba"], shell=False, stdin=PIPE ,stdout=PIPE)
		time.sleep(0.5)
		tempdir = "/tmp/"	
	
		if str(getpass.getuser()) == 'www-data':
			omc_objid = tempdir + "openmodelica.nobody.objid"
		else:
			omc_objid = tempdir + "openmodelica."+str(getpass.getuser())+".objid"
		if not os.path.isfile(omc_objid):
			time.sleep(2)
		

		orb = CORBA.ORB_init([], CORBA.ORB_ID)
		objid_file = os.open(omc_objid, os.O_RDWR)
		ior = os.read(objid_file, 500)

		#file("lacko",'wt')
		open(self.novyObjid,'wt')
		objid_subor = os.open(self.novyObjid,os.O_WRONLY)
		os.write(objid_subor,ior)
		os.close(objid_subor)

		objid_file = os.open(self.novyObjid, os.O_RDWR)
		ior = os.read(objid_file, 500)
		mico_obj = orb.resolve_initial_references("RootPOA")
		obj = orb.string_to_object(ior)
		self.omc = obj._narrow(_GlobalIDL.OmcCommunication)
######################posiela prikaz pre om##########################
	def poslatPrikaz(self,prikaz):			  			
			try: 
				vysledok = str(self.omc.sendExpression(prikaz))
			except:
				vysledok = "error: 'Tuto operaciu OpenModelica nedokazal vykonat!'"		
	 return vysledok
###################kontrola prikazu#############################	
	def filtrujPrikaz(self,prikaz):
		if re.search('system\ *\(',prikaz) != None or (re.search('cd\ *\(',prikaz) != None):
			return False
		else:
			return	True
		
###################vykona predosle prikazy#############################			   
	def vykonajStarePrikazy(self):
		vysledok = "a"
		if os.path.exists(self.prikazyFile):
			with open(self.prikazyFile, 'r') as prikazy:
				vsetkyPrikazy = prikazy.read()
			zoznam = vsetkyPrikazy.split('\n@@\n')
			for jeden in zoznam:
				self.omc.sendExpression(jeden)	
			#return "runScript(\""+os.getcwd()+"/"+self.prikazyFile+"\")"	
					
###################ukladanie prikazov#####################################
	def ukladajPrikaz(self, prikaz, vysledok):
		jePrikaz = 0
		if re.search('error:',vysledok) == None:
			#hladanie definicie premenne			
			if (re.search(':=',prikaz) != None) :
				jePrikaz = 1
			if re.search('function',prikaz) != None:
				jePrikaz = 1
			if re.search('class',prikaz) != None:
				jePrikaz = 1
			if re.search('model',prikaz) != None:
				jePrikaz = 1
			
			if jePrikaz > 0:
				if os.path.exists(self.prikazyFile):
					prikazy = open(self.prikazyFile,'a')
					prikazy.write("\n@@\n"+prikaz)
					prikazy.close()
				else:
					prikazy = open(self.prikazyFile,'w')
					prikazy.write(prikaz)				
					prikazy.close()	

###################ukoncenie om#####################################	
	def ukoncit(self):
		self.child.terminate()
		#os.system("rm "+self.novyObjid)

		
	
