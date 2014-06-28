<?php
  languages(array('15','31','45','56','57','59','60','61','62','63','64','65','66','81','84','87','126','127','128','129','130','131','133','140','141'));
if (userControll()) return 0;//kontrola prihlaseneho

	$loadedLangSK= dibi::query('SELECT * FROM  `lang` ORDER BY `lang`.`id`');
	$allLang= $loadedLangSK->fetchAll();

	if (isset($_SESSION['user']) && isset($_GET["id"])) {
			$tempReport = new Report();
			$res = $tempReport->getReportById($_GET["id"]);
			if($res == -1) return -1;
		if($tempReport->controller->name == null) {
			$tempReport->controller->name = $allLang[85-1]['content'.$lang];
			$tempReport->controller->cont_string = $allLang[85-1]['content'.$lang];
		}
		$smarty->assign('report',$tempReport);
	}
	$smarty->display('report.tpl');

?>