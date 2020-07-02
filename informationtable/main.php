<?php
require_once('../lib/DBConnection.php');
$db = DBConnection::getInstance();
$errordb['error'] = 'Повторите позже';
if($db->connect_error){
	echo json_encode($errordb);
	exit();
}

$res = $db->query("SELECT id, name FROM tickets WHERE window IS NULL ORDER BY time LIMIT 5");
if($res->num_rows>0){
while($row = $res->fetch_assoc()){
	$tickets['wait'][] = $row;
}
}
$res = $db->query("SELECT id, name, window FROM tickets WHERE window IS NOT NULL AND start IS NULL");
if($res->num_rows>0){
	while($row = $res->fetch_assoc()){
		$result = $db->query("SELECT name FROM windows WHERE id = '{$row['window']}'");
		$window = $result->fetch_assoc();
		$row['window'] = $window['name'];
		$tickets['call'][] = $row;
	}
}
if(isset($tickets)){
	echo json_encode($tickets);

}
