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
header('Content-disposition: attachment; filename="omResult.json"');

if(isset($_SESSION['user']) && isset($_GET['reportId'])) {
	$tempRep = new Report();
	$tempRep->getReportById($_GET['reportId']);

	$objArr = array($tempRep->temp,
	$tempRep->ftemp,
	$tempRep->light,
	$tempRep->flight,
	$tempRep->fan_out,
	$tempRep->fanrpm,
	$tempRep->ref_input,
	$tempRep->time);
	$resultArr = array();
	
	for($i=0;$i<sizeof($objArr);$i++) {
		$arr1 = str_replace('\'','',$objArr[$i]);
		$arr1 = str_replace('[','',$arr1);
		$arr1 = str_replace(']','',$arr1);
		$resultArr[] = explode(",", $arr1);
	}
	print "[";
	for($j=0;$j<sizeof($resultArr[0]);$j++) {
		print "{\"temp\":".$resultArr[0][$j].",\"ftemp\":".$resultArr[1][$j].",\"light\":".$resultArr[2][$j].",\"flight\":".$resultArr[3][$j].",\"fan_out\":".$resultArr[4][$j].",\"fanrpm\":".$resultArr[5][$j].",\"ref_input\":".$resultArr[6][$j].",\"time\":".$resultArr[7][$j]."},\n";
	}
	print "]";
}else {
	print "no data";
}
?>