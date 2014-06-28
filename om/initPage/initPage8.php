<?php
  languages(array('12','15','36','86','80','82','85','89','113','121','139'));
if (userControll()) return 0; //kontrola prihlaseneho

	$tempReport = new Report();
	if(isset($_REQUEST['saveReport']) && isset($_POST['reportId'])) {
		$tempReport->getReportById($_POST['reportId']);
		$tempReport->addReportComment($_POST['comments']);
	}
	if(isset($_GET['delete']) && $_SESSION['user']->permission < 2) {
		$toRemove = new Report();
		$toRemove->getReportById($_GET['delete']);
		$toRemove->removeReport();
	}

	if(isset($_SESSION['user']))  {
		if($_SESSION['user']->permission < 2) $reportArr = getAllReport();
		else $reportArr = getAllReportByLogin($_SESSION['user']->login);
	}
	if($reportArr) $smarty->assign('reportArr',$reportArr);
	$smarty->display('report_list.tpl');
?>