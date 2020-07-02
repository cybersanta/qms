<!DOCTYPE html>
<html lang=ru>
<head>
    <meta charset="UTF-8">
    <title>Выбор услуги</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="/css/main.css">

</head>
<body>
		<div class="content">
		<h2 class="menu-h2">Выбор услуги</h2>
		<div class="container">
			<hr>

		<?php
		require_once('../lib/DBConnection.php');
		$db = DBConnection::getInstance();
		if($db->connect_error){
			echo 'Повторите позже';
			exit();
		}
		$result = $db->query('SELECT id,name FROM services ORDER BY letter');
		if($result){
			while($row = $result->fetch_assoc()){
				echo '<div class="d-flex col-lg-4 justify-content-center terminal"><button class="btn2" value='.$row['id'].'>'.$row['name'].'</button></div>';
			}
			$result->free();

		}
		$db->close();

		?>
			<hr class="clear">
	 </div>

	 	

	 	
	</div>


	 <script type="text/javascript" src="/jquery-3.4.1.min.js"></script>
   <script type="text/javascript" src="main.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>