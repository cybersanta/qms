$(document).ready(function(){
	var idemployee = $('input[name="idemployee"]').val();
	$('select').change(function(){
		var windowname = $('select option:selected').html();
		var obj = $('form').serializeArray();
		$.ajax({
			url: 'main.php',
			type: 'POST',
			data: obj,
			success: function(data){
				if(data){
					data = $.parseJSON(data);
					if('success' in data){
						$('form').remove();
						$('.container').append('<h2>'+windowname+'</h2><div class="row justify-content-center"><p class="action"></p></div><div class="row justify-content-center"><div class="d-flex col-lg-4 justify-content-center"><button class="btn2" value="call">Вызвать клиента</button></div><div class="d-flex col-lg-4 justify-content-center"><button class="btn2" value="exit">Выйти</button></div></div><hr>');

					}else{
						$('body').append('<h2>'+data['error']+'</h2>');
					}
				}
			}
		});
	});
	$('body').on('click','button',function(){
		var obj = {idemployee:idemployee, action: $(this).val()};
		$.ajax({
			url: 'main.php',
			type: 'POST',
			data: obj,
			success: function(data){
				if(data){
					data = $.parseJSON(data);
					if('successcall' in data){
						$('.action').text('Клиент с услугой "'+data['successcall']+'" вызван');
						$('button[value = "call"]').text('Начать обслуживание');
						$('button[value = "call"]').val('start');
					}
					if('relax' in data){
						$('.action').text(data['relax']);
					}
					if('start' in data){
						$('.action').text(data['start']);
						$('button[value = "start"]').text('Закончить обслуживание');
						$('button[value = "start"]').val('end');
					}
					if('end' in data){
						$('.action').text(data['end']);
						$('button[value = "end"]').text('Вызвать клиента');
						$('button[value = "end"]').val('call');
					}
					if('exit' in data){
						window.location.replace(data['exit']);
					}
					if('error' in data){
						$('.action').text(data['error']);
					}

				}
			}
		});
	});
});