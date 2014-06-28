<?php 
require_once("skript/js/dibi/dibi.php");
include_once("/var/www/dp2/config.php");
dibi::connect($db_options);

require_once "classes/class.user.php";
require_once "classes/class.reservations.php";
require_once "classes/class.controller.php";
require_once "classes/class.report.php";

require_once 'smarty/libs/Smarty.class.php';

session_start();
$smarty = new Smarty();

if(isset($_GET['lang'])) {
	if($_GET['lang'] == 'SK' || $_GET['lang'] == 'EN') { 
		$lang = $_GET['lang'];
		$_SESSION['lang'] = $lang ;
	}else {
		$lang = 'SK';
		$_SESSION['lang'] = 'SK' ;
	}
}else if(isset($_SESSION['lang'])) {
	$lang = $_SESSION['lang'];
}else {
	$lang = 'SK';
}

if(isset($_SESSION['user'])) {
	 $smarty->assign('user',$_SESSION['user']);
}

////////////////////////////////////////////////////////////////////////////////////////////
function userControll() {
	global $smarty;
	if(!isset($_SESSION['user'])) {
		languages(array('6','7','8','9','10','11','122','123'));
		$smarty->display('home.tpl');
		return true;
	}
	else {
		return false;
	}
}
////////////////////////////////////////////////////////////////////////////////////////////
function validateUserData($dataArr) {
	global $lang;
	$chyby = array();
	$compareUser = new User();
	$loadedLangSK= dibi::query('SELECT * FROM  `lang` ORDER BY `lang`.`id`');
	$allLang= $loadedLangSK->fetchAll();
	foreach ($dataArr as $d => $data) {
		switch($d) {
			case "id":
					break;
			case "login":
					if(!preg_match("/^[A-Za-z0-9_]{3,20}$/",$data)) {$chyby[] = $allLang[74-1]['content'.$lang];};
					if($compareUser->getUserByName($data) == 0) {$chyby[] = $allLang[71-1]['content'.$lang];};
					break;
			case "name":
					if(!preg_match("/^[A-Za-z]+$/",$data))  {$chyby[] = $allLang[70-1]['content'.$lang];}
					break;
			case "surname":
					if(!preg_match("/^[A-Za-z]+$/",$data))  {$chyby[] = $allLang[72-1]['content'.$lang];}
					break;
			case "email":
					if(!preg_match("/^[a-zA-Z][a-zA-Z0-9\._]+@[a-zA-Z][a-zA-Z\.]+[a-zA-Z]\.([a-zA-Z]{2,3}|info)$/",$data)) {$chyby[]=$allLang[73-1]['content'.$lang]; }
					break;						
			case "password":
					if(!preg_match("/^[A-Za-z0-9!@#\$%\^&\*\(\)_]{5,20}$/",$data)) {$chyby[] = $allLang[75-1]['content'.$lang];}
					if(strcmp($data,$dataArr["password2"]) != 0) {$chyby[] = $allLang[76-1]['content'.$lang]; };
					break;
			case "password2":
					break;
			case "permission":
					if(!preg_match("/^[1-2]{1}$/",$data))  {$chyby[] = $allLang[112-1]['content'.$lang];}
					break;
		}
	}
    return $chyby;
}

/////////////////////////////////////////////////////////////////////////////////////////////
function dataControll($meno, $priezvisko, $email, $pouMeno, $heslo1, $heslo2) {
  global $lang;
  $permission = 2;
  $chyby = array();
	$loadedLangSK= dibi::query('SELECT * FROM  `lang` ORDER BY `lang`.`id`');
	$allLang= $loadedLangSK->fetchAll();

  //if(isset($_SESSION['user'])) $pouMeno = $_SESSION['user'];
  //TESTOVANIE S REGULARNYMI VYRAZMI
  if(!preg_match("/^[A-Za-z]+$/",$meno))  {$chyby[] = $allLang[70-1]['content'.$lang];}

	$tempUsr = new User();
	
	if(!isset($_SESSION['user']) && $tempUsr->getUserByName($pouMeno) == 0) {
		$chyby[] = $allLang[71-1]['content'.$lang];
	}
  
	if(!preg_match("/^[A-Za-z]+$/",$priezvisko))  {$chyby[] = $allLang[72-1]['content'.$lang];}
	if(!preg_match("/^[a-zA-Z][a-zA-Z0-9\._]+@[a-zA-Z][a-zA-Z\.]+[a-zA-Z]\.([a-zA-Z]{2,3}|info)$/",$email)) {$chyby[]=$allLang[73-1]['content'.$lang]; }
	if(!preg_match("/^[A-Za-z0-9_]{3,20}$/",$pouMeno)) {$chyby[] = $allLang[74-1]['content'.$lang];};
	if(!preg_match("/^[A-Za-z0-9!@#\$%\^&\*\(\)_]{5,20}$/",$heslo1)) {$chyby[] = $allLang[75-1]['content'.$lang];}
	if(strcmp($heslo1,$heslo2) != 0) {$chyby[] = $allLang[76-1]['content'.$lang]; };
    if(isset($_SESSION['user']) && $_SESSION['user']->permission < 2 )
    {
	$permission = 1;
    }
    if(isset($_SESSION['user'])&& sizeof($chyby) == 0) {
		// novy user: addUser(array(login,password,name,surname,email,permission))
		$_SESSION['user']->updateUser(array("login"=>$_SESSION['user']->login,"password"=>$heslo1,"name"=>$meno,"surname"=>$priezvisko,"email"=>$email,"permission"=>$permission));
     }
     else if (sizeof($chyby) == 0){
		$tempUsr->addUser(array("login"=>$pouMeno,"password"=>$heslo1,"name"=>$meno,"surname"=>$priezvisko,"email"=>$email,"permission"=>$permission));
      }
    return $chyby;
 }
////////////////////////////////////////////////////
function loginControll($nickname, $passw) {
	global $lang,$smarty ;
	$chyby = array();
	$loadedLangSK= dibi::query('SELECT * FROM  `lang` ORDER BY `lang`.`id`');
	$allLang= $loadedLangSK->fetchAll();

	if(strcmp($_POST['LdapLogin'],'LDAP') == 0)
	{
		$getUsr = ldapUserLogin($nickname, $passw);
	}else {
		$getUsr = simpleUserLogin($nickname, $passw);
	}
	if($getUsr) {
		$_SESSION['user'] = $getUsr;
		$smarty->assign('user',$getUsr);
	}else {
		$chyby[] = "<b>".$allLang[67-1]['content'.$lang]."</b>";
	}
	return $chyby;
}
////////////////////////////////////////////////////
function languages($text_arr) {
	global $lang, $smarty;
	
	$vysledok = dibi::query('SELECT * FROM  `lang` ORDER BY `lang`.`id`');
	$obsah = $vysledok->fetchAll();
  	for($i =0; $i<sizeof($text_arr);$i++)
  	{
		
		$smarty->assign('text'.$text_arr[$i],$obsah[($text_arr[$i]-1)]['content'.$lang]);
	}
}
////////////////////////////////////////////////////////////////////////////////////////////
$page = isset($_GET['page']) ? $_GET['page']: '1';
if($page == 11) {
  if(isset($_REQUEST['loginRequest'])) $smarty->assign('error_arr',loginControll($_POST['pouMeno'], $_POST['heslo']));
}
if($page == 13) {
	unset($_SESSION['user']);
	$smarty->clear_assign('user');
}

$smarty->assign('aktualPage',$page);
////////////////////////////////////////////////////////////////////////////////////////////

languages(array('58','1','2','3','4','5','88','109','113'));
$smarty->display('header.tpl');
$smarty->display('navigation_panel.tpl');


switch($page) {
	case '13': 		
		include_once "initPage/initPage13.php";
		break;
	case '12':
		include_once "initPage/initPage12.php";
		break;
	case '11':		
		include_once "initPage/initPage11.php";
		break;
	case '10':
		include_once "initPage/initPage10.php";
		break;
	case '9':
		include_once "initPage/initPage9.php";
		break;
	case '8':
		include_once "initPage/initPage8.php";
		break;
	case '7':
		include_once "initPage/initPage7.php";
		break;
	case '6':
		include_once "initPage/initPage6.php";
		break;
	case '5':		
		include_once "initPage/initPage5.php";
		break;
	case '4':	
		include_once "initPage/initPage4.php";
		break;
	case '3':
		include_once "initPage/initPage3.php";
		break;
	case '2':		
		include_once "initPage/initPage2.php";
		break;
	case '1':
	default :
		languages(array('6','7','8','9','10','11','122','123'));
		$smarty->display('home.tpl');
		break;
}
$smarty->display('footer.tpl');
?>