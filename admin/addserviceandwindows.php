<!DOCTYPE html>
<html lang=ru>
<head>
    <meta charset="UTF-8">
    <title>Добавить окна и услуги </title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="/css/main.css">

</head>
<body>
		<div class="content">
		<div class="container">
			<hr>
			<h2 class="addemployee-h2">Добавить окна и услуги</h2>


					<form>
							<div class="form-group">
								<div class="row justify-content-center">
									<span class="span-select">Количество окон в вашей организации: </span>
									<select class="sel" name="amount">
										<option value="0">Не добавлять окна</option>
										<?php
										for($i=1;$i<=15;$i++){
											echo '<option>'.$i.'</option>';
										}
										?>
									</select>
									<div id="form-group"><span class="error-text amount"></span></div>
								</div>
								

							
							<div class="row justify-content-center">
								<div class="d-inline-flex col-lg-3 justify-content-center">
									<input type="text" class="inpt2" name="name" placeholder="Введите название услуги" value=""/><br>
								</div>
								<div class="d-inline-flex col-lg-3 justify-content-center">
									<input type="text" class="inpt2" name="letter" placeholder="Буква на талоне" value=""/><br>					
								</div>
							</div>

							<div class="row justify-content-center">
								<div class="d-flex col-lg-3 justify-content-center">
									<span class="error-text name"></span>
								</div>
								<div class="d-flex col-lg-3 justify-content-center">
									<span class="error-text letter"></span>
								</div>
							</div>

							<div class="row justify-content-center">
								<input class="btn3" type="button" name="btnserviceandwindows" value="Сохранить"/>
							</div>

							<div class="row justify-content-center">							
								<div id="form-group2"><span class="error-text btnsw"></span></div>
							</div>

							<div class="row justify-content-center">
								<a class="btn3" href="<?='http://'.$_SERVER['SERVER_NAME'].'/admin/menu.php'?>">Вернуться в меню</a>
							</div>
					</div>
					 </form>
					 
			<hr>
		 </div>
		</div>

	  <script type="text/javascript" src="/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="main.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>