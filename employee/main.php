<?php
require_once('../lib/DBConnection.php');
$db = DBConnection::getInstance();
$errordb['error'] = 'Повторите позже';
if($db->connect_error){
	echo json_encode($errordb);
	exit();
}
$idwindow = $_POST['window']??null;
$idemployee = $_POST['idemployee']??null;
$action = $_POST['action']??null;
if(isset($idwindow) && isset($idemployee)){
	$res = $db->query("UPDATE windows SET employee = '$idemployee' WHERE id = '$idwindow'");
	if(!$res){
		echo json_encode($errordb);
		exit();
	}
	$work['success'] = 1;
	echo json_encode($work);
}
if(isset($action) && isset($idemployee)){
	if($action == 'call'){
		$res = $db->query("SELECT id, service FROM tickets WHERE service IN (SELECT service FROM employeesandservices WHERE employee = '$idemployee') AND window IS NULL ORDER BY time LIMIT 1");
		if(!$res){
		echo json_encode($errordb);
		exit();
		}
		if($res->num_rows===1){
			$ticket = $res->fetch_assoc();
			$res = $db->query("UPDATE tickets SET window = (SELECT id FROM windows WHERE employee = '$idemployee') WHERE id = '{$ticket['id']}'");
			if(!$res){
				echo json_encode($errordb);
				exit();
			}
			$res = $db->query("SELECT name FROM services WHERE id = '{$ticket['service']}'");
			if(!$res){
				echo json_encode($errordb);
				exit();
			}
			$nameservice = $res->fetch_assoc();
			$call['successcall'] = $nameservice['name'];
		}else{
			$call['relax'] = 'В очереди никого нет';
		}
		echo json_encode($call);
	}
	if($action == 'start' || $action == 'end'){
		$res = $db->query("SELECT id FROM tickets WHERE window = (SELECT id FROM windows WHERE employee = '$idemployee') AND (start IS NULL OR end IS NULL)");
		if(!$res){
		echo json_encode($errordb);
		exit();
		}
		$id = $res->fetch_assoc();
		if($action == 'start'){
			$res = $db->query("UPDATE tickets SET start = CURRENT_TIMESTAMP WHERE id = '{$id['id']}'");
			if(!$res){
				echo json_encode($errordb);
				exit();
			}
			$start['start'] = 'Началось обслуживание клиента';
			echo json_encode($start);
			exit();
		}
		$res = $db->query("UPDATE tickets SET end = CURRENT_TIMESTAMP WHERE id = '{$id['id']}'");
			if(!$res){
				echo json_encode($errordb);
				exit();
			}
			$end['end'] = 'Обслуживание клиента зкончено';
			echo json_encode($end);
			exit();
	}

	if($action == 'exit'){
		$res = $db->query("SELECT id FROM tickets WHERE window = (SELECT id FROM windows WHERE employee = '$idemployee') AND start IS NULL");
		if($res->num_rows>0){
			while($id=$res->fetch_assoc()){
				$db->query("UPDATE tickets SET window = NULL WHERE id = '{$id['id']}'");
			}
		}
		$res = $db->query("SELECT id FROM tickets WHERE window = (SELECT id FROM windows WHERE employee = '$idemployee') AND start IS NOT NULL AND end IS NULL");
		if($res->num_rows>0){
			while($row=$res->fetch_assoc()){
				$db->query("UPDATE tickets SET end = CURRENT_TIMESTAMP WHERE id = '{$row['id']}'");
			}
		}
		$res = $db->query("UPDATE windows SET employee = NULL WHERE employee = '$idemployee'");
		if(!$res){
		echo json_encode($errordb);
		exit();
	}
	$exit['exit'] = 'http://'.$_SERVER['SERVER_NAME'].'/index.php';
	echo json_encode($exit);
	}
}