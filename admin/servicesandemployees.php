<!DOCTYPE html>
<html lang=ru>
<head>
    <meta charset="UTF-8">
    <title>Назначение услуг сотрудникам</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="/css/main.css">
</head>
<body>
		<div class="content">

			<div class="container">
			<h2 class="menu-h2">Назначение услуг сотрудникам</h2>
			<hr>

	<form>
		<?php
		require_once('../lib/DBConnection.php');
		$db = DBConnection::getInstance();
		if($db->connect_error){
			$validation['error'] = 'Повторите позже';
			echo json_encode($validation);
			exit();
		}
		$services = '';
		$result = $db->query('SELECT id,name FROM services ORDER BY letter');
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$services.='<option value = '.$row['id'].'>'.$row['name'].'</option>';

			}
			$result->free();
		}else{
			echo 'Добавьте услуги';
		}
		$result = $db->query('SELECT id,fname,surname,patronymic FROM employees ORDER BY surname');
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				echo '<div class="form-group row border"> <div class="d-flex col-4 justify-content-left align-items-center"><span class="simpltext3">'.$row['surname'].' '. $row['fname'].' '.$row['patronymic'].'</span></div> <div class="d-flex col-4 justify-content-center"><select class="simpltext2" name="'.$row['id'].'" multiple>'.$services.'</select> </div>'; 
				$res = $db->query("SELECT name FROM services WHERE id IN (SELECT service FROM employeesandservices WHERE employee = '{$row['id']}')");
				if($res->num_rows>0){
					echo '<div class="col-4 justify-content-left access simpltext2" id="'.$row['id'].'"><div class="text-color simpltext2">Услуги доступные сотруднику:</div>';
					while($check = $res->fetch_assoc()){
						echo '<div>'.$check['name'].'</div>';
					}
					echo '</div>';
				}else{
					echo '<div class="col-4 justify-content-left access simpltext2" id="'.$row['id'].'"><div class="text-null simpltext2">Сотруднику не назначены услуги</div></div>';
				}
			echo '</div>';

			}
			$result->free();
			?>
			</form>

			<div class="row justify-content-center">
				<div class="d-flex col-4 justify-content-center">
					<button class="btn2" value="add">Добавить выбранные услуги</button>
				</div>
				<div class="d-flex col-4 justify-content-center">
					<button class="btn2" value="delete">Удалить выбранные услуги</button>
				</div>
			</div>

			<div class="form-group row justify-content-center">
				<div>
					<span class="buttons text-color"></span>
				</div>
			</div>
			<?php
		}else{
			echo '<h3>Добавьте сотрудников</h3>';
		}
		$db->close();
		?>
	<div class="row justify-content-center">
	 <a class="btn" href="<?='http://'.$_SERVER['SERVER_NAME'].'/admin/menu.php'?>">Вернуться в меню</a>
	</div>
<hr>
	 </div>

		
	 </div>
	</div>


	  <script type="text/javascript" src="/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="main.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>