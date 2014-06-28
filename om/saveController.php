<?php 

require_once("skript/js/dibi/dibi.php");
include_once("/var/www/dp2/config.php");
dibi::connect($db_options);

include_once ("classes/class.user.php");
include_once("classes/class.reservations.php") ;
include_once("classes/class.controller.php");
include_once("classes/class.report.php");
session_start();

if(isset($_SESSION['lang'])) { 
	$lang = $_SESSION['lang'];
}else {
	$lang = 'SK';
}

if(isset($_SESSION['user'])) {
	$loadedLangSK= dibi::query('SELECT * FROM  `lang` ORDER BY `lang`.`id`');
	$allLang= $loadedLangSK->fetchAll();
	$tempCont = new Controller();

	if(isset($_POST["activ"])) {
		if(strcmp($_POST["activ"],"true") == 0) {
			$activ = 1;
		}else{
			$activ = 0;
		}
	}else {
		$activ = 1;
	}

	switch($_POST["option"]) {
		case "saved":
			$tempCont->addController(array("name"=>$_POST['contName'],"parameter"=>$_POST['parameter'],"variable"=>$_POST['variable'],"equation"=>$_POST['equation'],"fun"=>$_POST['fun'],"led"=>$_POST['led'],"sample"=>$_POST['sample'],"login"=>$_SESSION['user']->login,"activ"=>1,"type"=>1,"timeLimit"=>$_POST['timeLimit']));
			break;
		case "add":
			if($_SESSION['user']->permission < 2) $cont_type = 0;
			else $cont_type = 1;
			$tempCont->addController(array("name"=>$_POST['contName'],"parameter"=>$_POST['parameter'],"variable"=>$_POST['variable'],"equation"=>$_POST['equation'],"fun"=>$_POST['fun'],"led"=>$_POST['led'],"sample"=>$_POST['sample'],"login"=>$_SESSION['user']->login,"activ"=>1,"type"=>$cont_type,"timeLimit"=>$_POST['timeLimit']));
			break;
		case "admin":
			$tempCont->getControllerById($_POST['id']);
			$tempCont->updateController(array("name"=>$_POST['contName'],"parameter"=>$_POST['parameter'],"variable"=>$_POST['variable'],"equation"=>$_POST['equation'],"fun"=>$_POST['fun'],"led"=>$_POST['led'],"sample"=>$_POST['sample'],"login"=>$_POST['userId'],"activ"=>$activ,"timeLimit"=>$_POST['timeLimit']));
			break;
	}
	echo "<script>alert('".$allLang[78-1]['content'.$lang]."');window.location.href=\"index.php?page=2\";</script>";
}
?>