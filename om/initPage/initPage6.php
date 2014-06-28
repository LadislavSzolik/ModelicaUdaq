<?php

      languages(array('111','36','49','50','82','109','110','137','144','145'));
	if(isset($_SESSION['user']) && $_SESSION['user']->permission < 2 ) {
		if(isset($_GET['delete'])) {
			$usr = new User();
			$usr->getUserById($_GET['delete']);
			$usr->removeUser();
		}

		$userList = getAllUser();
		if($userList != null ) {
			$smarty->assign('userList',$userList);
			$smarty->display('user_list.tpl');
		}
	}
?>