<!DOCTYPE html>
<html lang=ru>
<head>
    <meta charset="UTF-8">
    <title>Навигация</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="/css/main.css">
</head>
<body>
	<div class="content">
		<h2 class="menu-h2">Режим администратора</h2>
		<div class="container">
			<hr>


				<div class="row justify-content-center">
					<div class="d-flex col-lg-4 justify-content-center">
						<a class="btn2" href="<?='http://'.$_SERVER['SERVER_NAME'].'/admin/addemployee.php'?>">Добавить сотрудника</a>
					</div>
					<div class="d-flex col-lg-4 justify-content-center">
						<a class="btn2" href="<?='http://'.$_SERVER['SERVER_NAME'].'/admin/addserviceandwindows.php'?>">Добавить окна и услуги</a>
					</div>
				</div>

				<div class="row justify-content-center">
					<div class="d-flex col-lg-4 justify-content-center">
						<a class="btn2" href="<?='http://'.$_SERVER['SERVER_NAME'].'/admin/servicesandemployees.php'?>">Назначить услуги сотрудникам</a>
					</div>
					<div class="d-flex col-lg-4 justify-content-center">
						<input type="button" class="btn2" name="exit" value="Завершить рабочий день"/>
					</div>
				</div>

				<div class="row justify-content-center">
					<div id="form-group"><span class="error-text endday"></span></div>
				</div>
				<div class="row justify-content-center">
					<a class="btn2" href="<?='http://'.$_SERVER['SERVER_NAME'].'/index.php'?>">Выйти</a>
				</div>


		<hr>
	 </div>
	</div>


	  <script type="text/javascript" src="/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="main.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>