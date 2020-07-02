<!DOCTYPE html>
<html lang=ru>
<head>
    <meta charset="UTF-8">
    <title>Панель сотрудника</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="/css/main.css">

</head>
<body>
	<div class="content">
		<div class="container">
			<hr>
<?php
		$idemployee = $_GET['id']??null;
		if(isset($idemployee)){
			require_once('../lib/DBConnection.php');
			$db = DBConnection::getInstance();
			if($db->connect_error){
				echo 'Повторите позже';
				exit();
			}
			$res = $db->query("SELECT fname, surname, patronymic FROM employees WHERE id ='$idemployee'");
			if($res){
				$row = $res->fetch_assoc();
				echo '<h2>'.$row['surname'].' '.$row['fname'].' '.$row['patronymic'].'</h2>';
			}
			$res->free();
			$res = $db->query("SELECT name FROM windows WHERE employee = '$idemployee'");
			if($res->num_rows===1){
				$row = $res->fetch_assoc();
				echo '<h2>'.$row['name'].'</h2>';
				?>

			<div class="row justify-content-center">	
				<p id="simpltext3" class="action"></p>
			</div>

			<div class="row justify-content-center">
				<div class="d-flex col-lg-4 justify-content-center">
					<button class="btn2" value="call">Вызвать клиента</button>
				</div>
				<div class="d-flex col-lg-4 justify-content-center">
					<button class="btn2" value="exit">Выйти</button>
				</div>
			</div>
			<hr>
			<?php
			}else{
				$res = $db->query('SELECT id,name FROM windows WHERE employee IS NULL ORDER BY id');
				echo '<form><div class="row justify-content-center"><p>Выберите окно за которым вы работаете</p></div><div class="row justify-content-center"><select name="window"><option>Выбрать</option>';
				while($row = $res->fetch_assoc()){
					echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
				}
				echo '</select></div><hr>';
			}
		}
?>

<input type="hidden" name="idemployee" value="<?=$idemployee?>"/>
</form>

		
	 </div>
	</div>

    <script type="text/javascript" src="/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="main.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>