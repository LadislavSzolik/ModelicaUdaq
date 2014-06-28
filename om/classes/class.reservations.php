<?php

     include_once("/var/www/dp2/config.php");

class Reservation{
	
	var $id = -1;
	var $time_from = "0000-00-00 00:00"; 
	var $time_to = "0000-00-00 00:00";
	var $user_id = "";
	
	function Reservation(){
		global $db_options;
		dibi::connect($db_options);
	}
	
	function addReservation($from, $to, $user){
		$arr = array(
			'time_from'	=> mysql_real_escape_string($from),
			'time_to'	=> mysql_real_escape_string($to),
			'user_id'	=> mysql_real_escape_string($user),
		);
		dibi::query('INSERT INTO OMdatabase.reservations ', $arr);
		$this->id = dibi::getInsertId();
		$this->time_from = $from;
		$this->time_to = $to;
		$this->user_id = $user;
	}

	function getReservation($id){
		$result = dibi::query('SELECT * FROM OMdatabase.reservations WHERE id=%i',$id);
		$value = $result->fetchAll();
		if(!$value){
			return -1;
		}else{
			$this->id 	= $value[0]["id"];
			$this->time_from= $value[0]["time_from"];
			$this->time_to 	= $value[0]["time_to"];
			$this->user_id 	= $value[0]["user_id"];
			return 0;
		}
	}

	function getUserReservations($user){
		$result = dibi::query('SELECT * FROM OMdatabase.reservations WHERE user_id=%s',$user);
		$value = $result->fetchAll();
		if(!$value){
			return -1;
		}else{
			$this->id 	= $value[0]["id"];
			$this->time_from= $value[0]["time_from"];
			$this->time_to = $value[0]["time_to"];
			$this->user_id = $value[0]["user_id"];
			return 0;
		}
	}

	function checkReservationByUser($userId) {
		$result = dibi::query('SELECT * FROM OMdatabase.reservations WHERE user_id=%s',$userId);
		$value = $result->fetchAll();
		$control = 0;
		if(!$value){
			return 0;
		}else{
			foreach ($result as $n => $row) {
				if(strtotime('now')>= strtotime($row["time_from"]) && strtotime('now')< strtotime($row["time_to"]))
					$control = 1;
			}
			return $control;
		}
	}

	function getAllReservations(){
		$result = dibi::query('SELECT * FROM OMdatabase.reservations');
		$value = $result->fetchAll();
		if(!$value){
			return -1;
		}else{
			return $value;
		}
	}
	
	function setReservation($from, $to, $user){
		if($this->id == -1){
			$this->addReservation($from, $to, $user);
		}else{
			$arr = array(
				'time_from'	=> mysql_real_escape_string($from),
				'time_to'	=> mysql_real_escape_string($to),
				'user_id'	=> mysql_real_escape_string($user),
			);
			dibi::query('UPDATE OMdatabase.reservations SET ',$arr,' WHERE id=%i',$this->id);
			$this->time_from = $from;
			$this->time_to = $to;
			$this->user_id = $user;
		}
	}

	function deleteReservation(){
		dibi::query('DELETE FROM OMdatabase.reservations WHERE id=%i',$this->id);
	}

	function isReserved($from, $to){
		$reserved = false;
		$date1 = new DateTime($from);
		$date2 = new DateTime($to);

		$result = dibi::query('SELECT * FROM OMdatabase.reservations');
		$value = $result->fetchAll();
		if(!$value){
			return -1;
		}else{
			foreach ($result as $n => $row) {
				$tmp_date1 = new DateTime($row['time_from']);
				$tmp_date2 = new DateTime($row['time_to']);
				if( !(
				      ($tmp_date2 < $date1) ||
				      ($tmp_date1 > $date2)
				     ) &&
				     $this->id != $row['id'] &&
				     $reserved != true
				  )
				{
					$reserved = true;
				}
			}
			return $reserved;
		}
	}
}

function getAllReservations(){
	global $db_options;
	dibi::connect($db_options);
	$result = dibi::query('SELECT * FROM OMdatabase.reservations');
	$value = $result->fetchAll();
	$reservations = array();
	if(!$value){
		return -1;
	}else{
		foreach($result as $n => $row){
			$tmp = new Reservation();
			$tmp->id 	= $row["id"];
			$tmp->time_from = $row["time_from"];
			$tmp->time_to 	= $row["time_to"];
			$tmp->user_id 	= $row["user_id"];
			array_push($reservations, $tmp);
		}
		return $reservations;
	}
}
?>