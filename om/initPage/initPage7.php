<?php
languages(array('31','36','37','40','47','48','49','50','80','81','110','116','117','138','144','145'));
if(isset($_SESSION['user']) && $_SESSION['user']->permission < 2 ) {
		$choosedUser = new User();
		$compareUser = new User();
		
		if(isset($_GET['show'])) {
			$choosedUser->getUserById($_GET['show']);
			$smarty->assign('show',True);
		}
		/////////////////////////////////////////////////////
		if(isset($_GET['change'])) {
			$choosedUser->getUserById($_GET['change']);
			$smarty->assign('change',True);
		}
		/////////////////////////////////////////////////////
		if(isset($_GET['addNew'])) {
			$choosedUser = null;
			$smarty->assign('addNew',True);
		}
		/////////////////////////////////////////////////////
		if(isset($_REQUEST['updateUser'])) {

			$smarty->assign('change',True);
			$choosedUser->getUserById($_POST['id']);

			$tempUsr = new User();
			if(isset($_POST['newPassw'])) {
				$arr1 = array("id"=>$_POST['id'],
					"login"=>$_POST['login'],
					"password"=>$_POST['passw1'],
					"password2"=>$_POST['passw2'],
					"name"=>$_POST['name'],
					"surname"=>$_POST['surname'],
					"email"=>$_POST['email'],
					"permission"=>$_POST['permission']);
			}
			else {
				$arr1 = array("id"=>$_POST['id'],
					"login"=>$_POST['login'],
					"name"=>$_POST['name'],
					"surname"=>$_POST['surname'],
					"email"=>$_POST['email'],
					"permission"=>$_POST['permission']);
			}
			$arr = validateUserData($arr1);

			if (sizeof($arr) <= 0) {
				$tempUsr->getUserById($_POST['id']);
				$tempUsr->updateUser($arr1);
				$smarty->assign('succes',True);
			}else{
				$smarty->assign('errorArr',$arr);
			}

		}
		/////////////////////////////////////////////////////
		if(isset($_REQUEST['createUser'])) {
			$smarty->assign('addNew',True);

			$tempUsr = new User();
			$arr1 = array("login"=>$_POST['login'],
					"password"=>$_POST['passw1'],
					"password2"=>$_POST['passw2'],
					"name"=>$_POST['name'],
					"surname"=>$_POST['surname'],
					"email"=>$_POST['email'],
					"permission"=>$_POST['permission']);
			$arr = validateUserData($arr1);

			if (sizeof($arr) <= 0) {
				$tempUsr->addUser($arr1);
				$smarty->assign('succes',True);
			}else{
				$smarty->assign('errorArr',$arr);
			}
		}
		/////////////////////////////////////////////////////
		$smarty->assign('choosedUser',$choosedUser);
		$smarty->display('user.tpl');
	}
?>