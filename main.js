$(document).ready(function(){
	$('input[name="entry"]').click(function(){
		var obj = $('form').serializeArray();
		$.ajax({
			url: 'main.php',
			type: 'POST',
			data: obj,
			success: function(data){
				if(data){
					data = $.parseJSON(data);
					if('redirect' in data){
						window.location.href = data['redirect'];
					}else{
						$('.form-group div span').text(data['error'])
					}
			}
		
		}
	});
	});
	});