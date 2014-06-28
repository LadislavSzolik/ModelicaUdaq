<?php
	languages(array('88','90','91','92','93','94','95','96','97','98','99','100','101','102','103','104','105','106','107','108'));
	if (userControll()) return 0;//kontrola prihlaseneho
	if(isset($_GET['add_rez']) && isset($_REQUEST['time_from']) && isset($_REQUEST['time_to'])){
		$rez = new Reservation();
		$rez->addReservation($_REQUEST['time_from'],$_REQUEST['time_to'],$_SESSION['user']->id);
	}
	if(isset($_GET['delete']) && isset($_GET['reserv_id'])){
		$rez = new Reservation();
		$rez->getReservation($_GET['reserv_id']);
		$rez->deleteReservation();
	}

	$tmp_usr = new User();
	$all = getAllReservations();

	if($all>0) {
		foreach ($all as $item) {
			$tmp_usr->getUserById($item->user_id);
			$item->user_name = $tmp_usr->login;
		}
	}
	$smarty->assign('reservationArr',$all);
	$smarty->display('reservation.tpl');

?>