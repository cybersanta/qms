<?php
require_once('lib/DBConnection.php');
$db = DBConnection::getInstance();
$errordb['error'] = 'Повторите позже';
if($db->connect_error){
	echo json_encode($errordb);
	exit();
}
$_POST['login'] = 'BekBruce69';
$_POST['password'] = 'qwerty123456';

$login = $_POST['login']??null;
$password = $_POST['password']??null;
if(isset($login) && isset($password)){
	if(empty($login) || empty($password)){
		$authorization['error'] = 'Поля не должны быть пустыми';
		echo json_encode($authorization);
		$db->close();
		exit();
	}
	if($login == 'admin'){
		if($password == 'admin'){
			$authorization['redirect'] = 'http://'.$_SERVER['SERVER_NAME'].'/admin/menu.php';
		}else{
			$authorization['error'] = 'Неправильный логин или пароль';
		}
		echo json_encode($authorization);
		$db->close();
		exit();	
	}
	if($login == 'terminal'){
		if($password == 'terminal'){
			$authorization['redirect'] = 'http://'.$_SERVER['SERVER_NAME'].'/terminal/selectservice.php';
		}else{
			$authorization['error'] = 'Неправильный логин или пароль';
		}
		
		echo json_encode($authorization);
		$db->close();
		exit();	
	}
	if($login == 'information'){
		if($password == 'information'){
			$authorization['redirect'] = 'http://'.$_SERVER['SERVER_NAME'].'/informationtable/table.php';
		}else{
			$authorization['error'] = 'Неправильный логин или пароль';
		}
		
		
		echo json_encode($authorization);
		$db->close();
		exit();	
	}
	$res = $db->query("SELECT id, password FROM employees WHERE login = '$login'");
	if(!$res){
		echo json_encode($errordb);
		exit();
	}
	if($res->num_rows===1){
		$row = $res->fetch_assoc();
		if(password_verify($password,$row['password'])){
			$authorization['redirect'] = 'http://'.$_SERVER['SERVER_NAME'].'/employee/work.php?id='.$row['id'];
		}else{
			$authorization['error'] = 'Неправильный логин или пароль';
		}
		
	}else{
		$authorization['error'] = 'Пользователя не существует';
	}
	echo json_encode($authorization);
	}		
$db->close();