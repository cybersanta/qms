<?php
require_once('../lib/DBConnection.php');
$errordb['error'] = 'Повторите позже';
$db = DBConnection::getInstance();
if($db->connect_error){
	$errordb['error'] = 'Повторите позже';
}
$dtemployee['login'] = $_POST['login']??null;
$dtemployee['password'] = $_POST['password']??null;
$dtemployee['fname'] = $_POST['fname']??null;
$dtemployee['surname'] = $_POST['surname']??null;
$dtemployee['patronymic'] = $_POST['patronymic']??null;
$check = true;
foreach ($dtemployee as $value) {
	if (!isset($value)) $check = false;
	break;
}
if($check){
	require_once('../lib/Employee.php');
	$employee = new Employee($dtemployee);
	$validation = $employee->getValidation();
	if(!empty($validation)){
		echo json_encode($validation);
	}else{
		$result = $employee->addEmployee($db);
		if($result === 1) {
			$validation['success'] = 'Пользователь добавлен';
		}elseif(strripos($result, 'login')!==false){
			$validation['login'] = 'Сотрудник с данным логином уже существует';
		}else{
			$validation['error'] = 'Повторите позже';
		}
		echo json_encode($validation);
	}
}
$serviceandwindows['name'] = $_POST['name']??null;
$serviceandwindows['letter'] = $_POST['letter']??null;
$serviceandwindows['amount'] = $_POST['amount']??null;
$check = true;

foreach ($serviceandwindows as $value) {
	if (!isset($value)) $check = false;
	break;
}

if($check){
	if(!empty($serviceandwindows['name']) || !empty($serviceandwindows['letter'])){
		require_once('../lib/Service.php');
		$service = new Service($serviceandwindows);
		$validation = $service->getValidation();
		if(empty($validation)){
			$result = $service->addService($db);
			if($result === 1){
				$validation['servicesuccess'] = 'Услуга добавлена';
			}elseif(strripos($result, 'name')!==false){
				$validation['service'] = 'Данная услуга уже существует';
			}else{
				$validation['error'] = 'Повторите позже';
			}
		}
	}
	require_once('../lib/Window.php');
	$window = new Window($serviceandwindows);
	$windowvalid = $window->getValidation();
	if($windowvalid){
		$validation['window'] = $windowvalid;
	}else{
		$resultwin = $window->addWindows($db);
		if($resultwin === 1){
			$validation['successwindow'] = 'Окна добавлены';
		}elseif ($resultwin === -1) {
			$validation['window'] = 'В организации должны быть окна';
		}
	}

	if(!empty($validation)){
		echo json_encode($validation);
	}
	
}
$dtrelation = $_POST['relation']??null;
$dtaction = $_POST['action']??null;
if(isset($dtrelation) && isset($dtaction)){
	if($dtaction == 'add'){
		foreach($dtrelation as $key=>$value){
		for($i=0; $i < count($value); $i++){
			$check = $db->query("SELECT id FROM employeesandservices WHERE employee = '$key' AND service = '$value[$i]' ");
			if($check->num_rows==0){
				$res = $db->query("INSERT INTO employeesandservices (id, employee, service) VALUES (NULL, '$key', '$value[$i]')");
			if(!$res){
				$validation['error'] = 'Повторите попытку позже';
				break;
			}
			}
			
		}
	}
	$validation['success'] = 'Услуги сотрудникам назначены';
	}else{
		foreach($dtrelation as $key=>$value){
		for($i=0; $i < count($value); $i++){
			$res = $db->query("DELETE FROM employeesandservices WHERE employee = '$key' AND service = '$value[$i]'");
			if(!$res){
				$validation['error'] = 'Повторите попытку позже';
				break;
			}
		}
	}
		$validation['success'] = 'Выбранные услуги удалены';
	
	}
	$employees = $db->query("SELECT id FROM employees");
	while($employee = $employees->fetch_assoc()){
		$service = $db->query("SELECT name FROM services WHERE id IN (SELECT service FROM employeesandservices WHERE employee = '{$employee['id']}')");
		while($name = $service->fetch_assoc()){
			$validation['services'][$employee['id']][] = $name['name'];
		}
	}
	echo json_encode($validation);
	
}
$dtexit = $_POST['exit']??null;
if(isset($dtexit)){
	$db->query("TRUNCATE tickets");
	$db->query("UPDATE services SET queue = 0");
	$exit['success'] = 'Талоны удалены, очереди обновлены';
	echo json_encode($exit);
}
$db->close();