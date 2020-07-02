<!DOCTYPE html>
<html lang=ru>
<head>
    <meta charset="UTF-8">
    <title>Добавить сотрудника</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="/css/main.css">
		
</head>
<body>
	<div class="content">
		<div class="container">
			<hr>
			<h2 class="addemployee-h2">Добавить сотрудника</h2>
			<div class="d-flex justify-content-center">	

					<form>
						<div class="form-group">
							<div class="row justify-content-center">
								<input type="text" name="surname" class="inpt" placeholder="Введите фамилию"/> 
						  </div>
						  <div id="form-group"><span class="error-text surname"></span></div>
							
							<div class="row justify-content-center">
								<input type="text" name="fname" class="inpt" placeholder="Введите имя"/>
						  </div>
						  <div id="form-group"><span class="error-text fname"></span></div>

							<div class="row justify-content-center">
								<input type="text" name="patronymic" class="inpt" placeholder="Введите отчество"/>
							</div>
							<div id="form-group"><span class="error-text patronymic"></span></div>
							
							<div class="row justify-content-center">
								<input type="text" name="login" class="inpt" placeholder="Введите логин"/>	
							</div>
							<div id="form-group"><span class="error-text login"></span></div>
							
							<div class="row justify-content-center">
								<input type="password" name="password" class="inpt" placeholder="Введите пароль"/>	
							</div>
							<div id="form-group"><span class="error-text password"></span></div>
							
							<div class="row justify-content-center">
								<input type="button" name="addemployee" class="btn" value="Добавить">
							</div>
							<div id="form-group"><span class="error-text btnerr"></span></div>

							<div class="form-group row justify-content-center">
								<a class="btn" href="<?='http://'.$_SERVER['SERVER_NAME'].'/admin/menu.php'?>">Вернуться в меню</a>	
							</div>
							
						</div>
				 </form>

		 </div>
		<hr>
	 </div>
	</div>

		<script type="text/javascript" src="/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="main.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>