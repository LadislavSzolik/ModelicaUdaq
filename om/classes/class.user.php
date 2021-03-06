<?php

include_once("/var/www/dp2/config.php");
/* user class */
// novy user: addUser(array(login,password,name,surname,email,permission))
class User{
	var $id = -1;
	var $login = "";
	var $password = "";
	var $name = "";
	var $surname = "";
	var $email = "";
	var $permission = "2";
	var $ip = "";
	var $ldap = false;
	function User() {
		global $db_options;
		dibi::connect($db_options);
	}

	function addUser($userArr) {
		$inArr = array();
		foreach ($userArr as $u => $data) {
			if(strcmp($u,"password") == 0) 
				$inArr[$u] =  sha1(mysql_real_escape_string($data));
			else if(strcmp($u,"password2") == 0){}
			else
				$inArr[$u] =  mysql_real_escape_string($data);
		}
		$inArr["ip"] = $this->getRealIpAddr();
		dibi::query('INSERT INTO `users` ', $inArr);
		$this->id = dibi::getInsertId();
		$this->login = $userArr["login"];
		$this->password = sha1($userArr["password"]);
		$this->name = $userArr["name"];
		$this->surname = $userArr["surname"];
		$this->email = $userArr["email"];
		$this->permission = $userArr["permission"];
		$this->ip = $this->getRealIpAddr();
	}

	function removeUser() {
		dibi::query('DELETE FROM `users` WHERE id=%i',$this->id);
	}

	function getUserById($id) {
		$result = dibi::query('SELECT * FROM `users` WHERE id=%i',$id);
		$value = $result->fetchAll();
		if(!$value){
			return -1;
		}else{
			$this->id = $value[0]["id"];
			$this->login = $value[0]["login"];
			$this->password = $value[0]["password"];
			$this->name = $value[0]["name"];
			$this->surname = $value[0]["surname"];
			$this->email = $value[0]["email"];
			$this->permission = $value[0]["permission"];
			$this->ip = $value[0]["ip"];
			$this->datum = $value[0]["datum"];
			return 0;
		}
	}

	function updateUser($userArr) {
		$inArr = array();
		foreach ($userArr as $u => $data) {
			if(strcmp($u,"password") == 0) 
				$inArr[$u] =  sha1(mysql_real_escape_string($data));
			else if(strcmp($u,"password2") == 0){}
				 
			else
				$inArr[$u] =  mysql_real_escape_string($data);
		}
		$inArr["ip"] = $this->getRealIpAddr();
		dibi::query("UPDATE `users` SET ",$inArr ," WHERE id=%i",$this->id);
		$this->login = $userArr["login"];
		if (isset($userArr["password"]))
			$this->password = sha1($userArr["password"]);
		$this->name = $userArr["name"];
		$this->surname = $userArr["surname"];
		$this->email = $userArr["email"];
		$this->permission = $userArr["permission"];
		$this->ip = $this->getRealIpAddr();
	}

	function getUserByName($name) {
		$result = dibi::query('SELECT * FROM `users` WHERE login=%s',$name);
		$value = $result->fetchAll();
		if(!$value){
			return -1;
		}else{
			$this->id = $value[0]["id"];
			$this->login = $value[0]["login"];
			$this->password = $value[0]["password"];
			$this->name = $value[0]["name"];
			$this->surname = $value[0]["surname"];
			$this->email = $value[0]["email"];
			$this->permission = $value[0]["permission"];
			$this->ip = $value[0]["ip"];
			$this->datum = $value[0]["datum"];
			return 0;
		}
	}
	function getRealIpAddr() {
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
		{
		$ip=$_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		{
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
		$ip=$_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}

	
}
function getAllUser() {
	global $db_options;
	dibi::connect($db_options);
	$result = dibi::query('SELECT * FROM `users` ORDER BY `users`.`id`');
	$value = $result->fetchAll();
	$users = array();
	
	if(!$value){
		return null;
	}else{
		foreach($result as $n => $row){
			$tmp = new User();
			$tmp->id = $row["id"];
			$tmp->login = $row["login"];
			$tmp->password = $row["password"];
			$tmp->name = $row["name"];
			$tmp->surname = $row["surname"];
			$tmp->email = $row["email"];
			$tmp->permission = $row["permission"];
			$tmp->ip = $row["ip"];
			array_push($users, $tmp);
		}
		return $users;
	}
}
function simpleUserLogin($usr_name, $passw) {
	$usr_name = mysql_real_escape_string($usr_name);
	$passw = sha1(mysql_real_escape_string($passw));

	$tempUsr = new User();
	if($tempUsr->getUserByName($usr_name) >=0) {
		if(strcmp($tempUsr->password,$passw)==0){
			$inArr = array(
				"ip"=>$tempUsr->getRealIpAddr(),
				"datum"=>date("Y-m-d H:i:s")
			);
			dibi::query("UPDATE `users` SET ",$inArr ," WHERE id=%i",$tempUsr->id);
			return $tempUsr;
		}else
			return null;
	}else
		return null;
	
}

function ldapUserLogin($usr_name, $passw) {
	$ds = ldap_connect("ldap.stuba.sk");
	$tempUsr = new User();

	if(!$ds) {
		return null;
	}
	$bn = 'uid='.$usr_name.',ou=People,dc = stuba, dc = sk';
	$r = @ldap_bind($ds,$bn,$passw);
	if($r == null ) {
		return null;
	}
	if($tempUsr->getUserByName($usr_name) < 0) {
		
	$tempUsr->addUser(array("login"=>$usr_name,"password"=>$passw,"name"=>"null","surname"=>"null","email"=>$usr_name."@stuba.sk","permission"=>2));
	}
	$tempUsr->ldap = true;
	ldap_close($ds);
	return $tempUsr;

}


?>