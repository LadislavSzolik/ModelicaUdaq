<?php
	languages(array('17','18','19','20','21','54','55','56','57','65','81','118','120','126','127','128','129','130','131','133','142','143'));
	$tempCont = new Controller();
	if (userControll()) return 0;//kontrola prihlaseneho

	if(isset($_POST['contId'])) {
		$tempCont->getControllerById($_POST['contId']);
		$tempCont->setController(array("name"=>$_POST['contName'],"equation"=>$_POST['equation'],"fun"=>$_POST['fun'],"led"=>$_POST['led'],"sample"=>$_POST['sample'],"timeLimit"=>$_POST['timeLimit'],"cont_string"=>$_POST['cont_string'],"parameter"=>$_POST['parameter'],"variable"=>$_POST['variable']));
		$_SESSION['usedController'] = $tempCont;
		$smarty->assign('backFunc','page=3&show='.$_POST['contId']);
	}else if(isset($_GET['simCont'])) {
		$res = $tempCont->getControllerById($_GET['simCont']);
		if($res == -1) return -1;
		$smarty->assign('backFunc','page=2');
	}else
		return -1;
	$smarty->assign('controller',$tempCont);
	$smarty->display('model_sim.tpl');
?>