<?php
	languages(array('40','42','43','44','45','46','47','48','49','50','51','52','136'));
	if( isset($_SESSION['user'])) {
		$smarty->assign('pouMeno',$_SESSION['user']->login);
		$smarty->assign('meno',$_SESSION['user']->name);
		$smarty->assign('priezvisko',$_SESSION['user']->surname);
		$smarty->assign('email',$_SESSION['user']->email);
	}
	if(isset($_REQUEST['registerRequest'])) {
		$smarty->assign('smartyRegisterRequest','ok');
		$smarty->assign('error_arr',dataControll($_POST['meno'],$_POST['priezvisko'],$_POST['email'],$_POST['pouMeno'],$_POST['heslo1'],$_POST['heslo2']));
  	}
	if(isset($_REQUEST['changeRequest'])) {
		$smarty->assign('smartyChangeRequest','ok');
		$smarty->assign('error_arr',dataControll($_POST['meno'],$_POST['priezvisko'],$_POST['email'],$_POST['pouMeno'],$_POST['heslo1'],$_POST['heslo2']));
	}
	$smarty->display('register.tpl');
?>