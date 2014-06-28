<?php session_start();
require_once("skript/js/dibi/dibi.php");
require_once 'smarty/libs/Smarty.class.php';
include "classes/class.user.php";
include "classes/class.reservations.php";
include "classes/class.controller.php";
include "classes/class.report.php";

dibi::connect(array(
  'driver' => 'mysql',
  'host' => '127.0.0.1',
  'username' => 'root',
  'password' => 'syoliklaci',
  'database' => 'OMdatabase',
  'charset' => 'utf8',
));

header("Content-Type: application/octet-stream\n");
header('Content-disposition: attachment; filename="omResult.txt"');

if(isset($_SESSION['user']) && isset($_GET['reportId'])) {
	$tempRep = new Report();
	$tempRep->getReportById($_GET['reportId']);
			
	print "temp:\n".$tempRep->temp."\nftemp:\n".$tempRep->ftemp."\nlight:\n".$tempRep->light."\nflight:\n".$tempRep->flight;
	print "\nfan_out:\n".$tempRep->fan_out."\nfanrpm:\n".$tempRep->fanrpm."\nref_input:\n".$tempRep->ref_input."\ntime:\n".$tempRep->time;
}else {
	print "no data";
}
?>