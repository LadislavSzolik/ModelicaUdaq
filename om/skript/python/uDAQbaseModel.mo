function omReadWrite
	input Real x;
	input Real y;
	input Real z;

	output String c;
external
  c = om_read_write(x,y,z) annotation(Library="udaq28lt_driver.o -lusb", Include="#include \"udaq28lt_driver.h\"");
end omReadWrite;


function tStr
	input String a;
	input Integer b;
	output Real x;
external
	  x = transformStr(a,b) annotation(Library="udaq28lt_driver.o -lusb", Include="#include \"udaq28lt_driver.h\"");
end tStr;


connector udaqOut
  Real value;
end udaqOut;

connector udaqIn 
  Real value;
end udaqIn;


model Udaq
	parameter Real fun;
	parameter Real led;
	parameter Real Ts;
	parameter Real Cor = 5/80;
	Real out1;
	Real out2;
	Real out3;
	Real out4;
	Real out5;
	Real out6;
	udaqOut uOut;
	udaqIn  uIn;
	Real tempIn;
	String str;
equation	
	tempIn = uIn.value*Cor;
	when 1 then
		str = omReadWrite(tempIn,fun,led);
		reinit(out1,tStr(str,1));
		reinit(out2,tStr(str,2));
		reinit(out3,tStr(str,3));
		reinit(out4,tStr(str,4));
		reinit(out5,tStr(str,5));
		reinit(out6,tStr(str,6));
	end when;
	out1 = out1;
	out2 = out2;
	out3 = out3;
	out4 = out4;
	out5 = out5;
	out6 = out6;
	uOut.value = out4;
end Udaq;

