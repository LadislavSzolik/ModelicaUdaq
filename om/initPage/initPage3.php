<?php
  languages(array('12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','81','83','118','119','120','132','133','143'));
  $tempCont = new Controller();
	$res = -1;	
	if(isset($_SESSION['show'])) $_GET['show'] = $_SESSION['show'];
	if(isset($_SESSION['addNew'])) $_GET['addNew'] = $_SESSION['addNew'];
	
	if(isset($_GET['show']))
	{
		$_SESSION['show'] = $_GET['show'];
		if(isset($_SESSION['usedController'])){
			$tempCont = $_SESSION['usedController'];
			unset($_SESSION['usedController']);
			$res = 0;
		}
		else {
			$res = $tempCont->getControllerById($_GET['show']);
		}

		if(isset($_SESSION['user'])) {
			if($_SESSION['user']->permission > 1 && $tempCont->type == 1) {
				$smarty->assign('option','saved');
			}else if($_SESSION['user']->permission > 1 && $tempCont->type == 0) {
				$smarty->assign('option','default');
			}else if($_SESSION['user']->permission < 2)	{
				if($tempCont->type == 1) {
					$smarty->assign('secondOpt','default');
				}
				$smarty->assign('option','admin');
			}
		}else {
			$smarty->assign('option','default');
		}
		
	}else if(isset($_GET['addNew'])) {
		$_SESSION['addNew'] = $_GET['addNew'];
		$smarty->assign('option','add');
		$res = $tempCont->getDefaultController();
		
	}
	if( $res == -1) return 0;

	$smarty->assign('controller',$tempCont);
	$smarty->display('controller.tpl');
?>