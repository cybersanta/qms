$(document).ready(function(){
	$('input[name="exit"]').click(function(){
		$.ajax({
			url: 'main.php',
			type: 'POST',
			data: {'exit':'1'},
			success: function(data){
				if(data){
				data = $.parseJSON(data);
				$('.endday').text(data['success']);
				$('.endday').css('color', 'green');
			}
		}
	});
	});
	$('button').click(function(){
		var obj = $('form').serializeArray();
		var jsondata = {};

		jsondata['relation'] = {};
		for(var i in obj){
			i = $.parseJSON(i);
			var name = obj[i]['name'];
			var value = obj[i]['value'];
			if(!(name in jsondata['relation'])){
				jsondata['relation'][name] = [];
			}
			jsondata['relation'][name].push(value); 
		}
		jsondata['action'] = $(this).val();
		$.ajax({
			url: 'main.php',
			type: 'POST',
			data: jsondata,
			success: function(data){
				if(data){
				data = $.parseJSON(data);
				if('success' in data){
					$('.buttons').text(data.success);
					$('select').val('');
					var services = data['services'];
					$('.access').empty();
					for(var key in services){
						$('#'+key).append('<div class="text-color">Услуги доступные сотруднику:</div>');
						for(var i = 0; i<services[key].length; i++){
							$('#'+key).append('<div>'+services[key][i]+'</div>');
						}
					}
					var arr = $('.access').toArray();
					for(var i = 0; i<arr.length; i++){
						var elem = $(arr[i]);
						var check = elem.text();
						if(!check){
							elem.append('<div class="text-null">Сотруднику не назначены услуги</div>')
						}
					}

				}else if('error' in data){
					$('.buttons').text(data.error);
				}else{
					$('.buttons').text('');
				}
				$('select').focus(function(){
					if('success' in data){
						$('.buttons').text('');
					}
					});
			}
		}
	});
	});

	$('input[name="btnserviceandwindows"]').click(function(){
		var obj = $('form').serializeArray();
		$.ajax({
			url: 'main.php',
			type: 'POST',
			data: obj,
			success: function(data){
				if(data){
				data = $.parseJSON(data);
				if('window' in data){
					$('.amount').text(data.window);
				}else{
					$('.amount').text('');
				}
				if('service' in data){
					$('input[name="name"]').val('');
					$('.name').text(data.service);
				}else{
					$('.name').text('');
				}
				if('letter' in data){
					$('input[name="letter"]').val('');
					$('.letter').text(data.letter);
				}else{
					$('.letter').text('');
				}
				if('servicesuccess' in data && 'successwindow' in data){
					$('.btnsw').css('color','green');
					$('.btnsw').text('Окна и услуга добавлены');
					$('input[name!="btnserviceandwindows"]').val('');
				}else if('servicesuccess' in data){
					$('.btnsw').css('color','green');
					$('.btnsw').text(data.servicesuccess);
					$('input[name!="btnserviceandwindows"]').val('');
				}else if('successwindow' in data){
					$('.btnsw').css('color','green');
					$('.btnsw').text(data.successwindow);
				}else if('error' in data){
					$('.btnsw').text(data.error);
				}else{
					$('.btnsw').text('');
				}
				$('input').focus(function(){
					$('.btnsw').text('');
				});
				
			}
		}
	});
	});
	$('input[name="addemployee"]').click(function(){
		var obj = $('form').serializeArray();
		$.ajax({
			url: 'main.php',
			type: 'POST',
			data: obj,
			success: function(data){
				if(data){
				data = $.parseJSON(data);
				if ('login' in data){
					$('input[name="login"]').val('');
					$('.login').text(data.login);
				}else{
					$('.login').text('');
				}

				if ('password' in data){
					$('input[name="password"]').val('');
					$('.password').text(data.password);
				}else{
					$('.password').text('');
				}
				if ('fname' in data){
					$('input[name="fname"]').val('');
					$('.fname').text(data.fname);
				}else{
					$('.fname').text('');
				}
				if ('surname' in data){
					$('input[name="surname"]').val('');
					$('.surname').text(data.surname);
				}else{
					$('.surname').text('');
				}
				if ('patronymic' in data){
					$('input[name="patronymic"]').val('');
					$('.patronymic').text(data.patronymic);
				}else{
					$('.patronymic').text('');
				}
				if('success' in data){
					$('.btnerr').text(data.success);
					$('.btnerr').css('color', 'green');
					$('input[name!="addemployee"]').val('');

				}else if('error' in data){
					$('.btnerr').text(data.error);
					$('.btnerr').css('color', 'red');
				}else{
					$('.btnerr').text('');
				}
				$('input').focus(function(){
					if('success' in data){
						$('.btnerr').text('');
					}
					});
			}				
			}

		});
	});
});