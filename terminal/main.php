<?php
require_once('../lib/DBConnection.php');
$db = DBConnection::getInstance();
$errordb['error'] = 'Повторите позже';
if($db->connect_error){
	echo json_encode($errordb);
	exit();
}
$idservice = $_POST['id']??null;
if(isset($idservice)){
	$res = $db->query("SELECT letter,queue FROM services WHERE id = $idservice");
	if(!$res){
		echo json_encode($errordb);
		exit();
	}
	$row = $res->fetch_assoc();
	$res->free();
	$queue = ++$row['queue'];
	$letter = $row['letter'];
	if($queue>999){
		$queue = 1;
	}
	$res = $db->query("UPDATE services SET queue = $queue WHERE letter = '$letter'");
	if(!$res){
		echo json_encode($errordb);
		exit();
	}
	if($queue<10){
		$ticket['name'] = "{$letter}00{$queue}";
	}elseif ($queue<100) {
		$ticket['name'] = $letter.'0'.$queue;
		
	}else{
		$ticket['name'] = $letter.$queue;
	}
	$res = $db->query("INSERT INTO tickets (id, name, window, service) VALUES (NULL, '{$ticket['name']}', NULL, '$idservice')");
	if(!$res){
		echo json_encode($errordb);
		exit();
	}
	echo json_encode($ticket);
}
$db->close();
