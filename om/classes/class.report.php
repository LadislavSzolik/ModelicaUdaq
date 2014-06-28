<?php
	include_once("/var/www/dp2/config.php");
	//include "classes/class.controller.php";

class Report{
	var $id = "";
	var $login = "";
	var $controllerId = "";
	var $usedController = "";
	var $temp = "";
	var $ftemp = "";
	var $light = "";
	var $flight = "";
	var $fan_out = "";
	var $fanrpm = "";
	var $time = "";
	var $ref_input = "";
	var $startTime = "";
	var $endTime = "";
	var $comments = "";
	public $controller = null;


	function Report() {		
		$this->controller = new Controller();
	}	
	function removeReport() {
		dibi::query('DELETE FROM `reports` WHERE id=%i',$this->id);
	}
	function getReportById($id) {
		$result = dibi::query('SELECT * FROM `reports` WHERE id=%i',$id);
		$value = $result->fetchAll();
		if(!$value){
			return -1;
		}else{
			$this->id = $value[0]["id"];
			$this->login = $value[0]["login"];
			$this->controllerId = $value[0]["controllerId"];
			$this->usedController  = $value[0]["usedController"];

			$this->temp = $value[0]["temp"];
			$this->ftemp = $value[0]["ftemp"];
			$this->light = $value[0]["light"];
			$this->flight = $value[0]["flight"];
			$this->fan_out = $value[0]["fan_out"];
			$this->fanrpm = $value[0]["fanrpm"];
			$this->time = $value[0]["time"];
			$this->ref_input = $value[0]["ref_input"];

			$this->startTime = $value[0]["startTime"];
			$this->endTime = $value[0]["endTime"];
			$this->comments = str_replace('\r',"\r",(str_replace('\n',"\n",$value[0]["comments"])));
			$this->getReportCont($value[0]["controllerId"]);
			
			return 0;
		}
	}
	function getReportCont($id) {
		
		$res = $this->controller->getControllerById($id);
		if($res == -1) 
			$this->controller->name = "-1";
		if($res == -2)
			$this->controller->name = "-2";
	}
	function addReportComment($comment) {
		dibi::query("UPDATE `reports` SET", array(
    	'comments' => mysql_real_escape_string($comment),
    	)," WHERE id=%i",$this->id);
	}
}


function getAllReport() {
	global $db_options;
	dibi::connect($db_options);
	$result = dibi::query('SELECT * FROM `reports` ORDER BY `reports`.`id`');
	$value = $result->fetchAll();
	$reports = array();
	if(!$value){
		return null;
	}else{
		foreach($result as $n => $row){
			$tmp = new Report();
			$tmp->id = $row["id"];
			$tmp->login = $row["login"];
			$tmp->controllerId = $row["controllerId"];
			$tmp->usedController = $row["usedController"];

			$tmp->temp = $row["temp"];
			$tmp->ftemp = $row["ftemp"];
			$tmp->light = $row["light"];
			$tmp->flight = $row["flight"];
			$tmp->fan_out = $row["fan_out"];
			$tmp->fanrpm = $row["fanrpm"];
			$tmp->time = $row["time"];
			$tmp->ref_input = $row["ref_input"];

			$tmp->startTime = $row["startTime"];
			$tmp->endTime = $row["endTime"];
			$tmp->comments = str_replace('\r',"\r",(str_replace('\n',"\n",$row["comments"])));
			$tmp->getReportCont($row["controllerId"]);
			array_push($reports, $tmp);
		}
		return $reports;
	}
}

function getAllReportByLogin($login) {
	//global $db_options;
	//dibi::connect($db_options);
	$result = dibi::query('SELECT * FROM `reports` WHERE login=%s',$login);
	$value = $result->fetchAll();
	$reports = array();
	
	if(!$value){
		return null;
	}else{
		foreach($result as $n => $row){
			$tmp = new Report();
			$tmp->id = $row["id"];
			$tmp->login = $row["login"];
			$tmp->controllerId = $row["controllerId"];
			$tmp->usedController  = $row["usedController"];
			$tmp->temp = $row["temp"];
			$tmp->ftemp = $row["ftemp"];
			$tmp->light = $row["light"];
			$tmp->flight = $row["flight"];
			$tmp->fan_out = $row["fan_out"];
			$tmp->fanrpm = $row["fanrpm"];
			$tmp->time = $row["time"];
			$tmp->ref_input = $row["ref_input"];
			$tmp->startTime = $row["startTime"];
			$tmp->endTime = $row["endTime"];
			$tmp->comments = str_replace('\r',"\r",(str_replace('\n',"\n",$row["comments"])));
			$tmp->getReportCont($row["controllerId"]);
			array_push($reports, $tmp);
		}
		return $reports;
	}
}


?>