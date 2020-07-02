$(document).ready(function(){
	$('button').click(function(){
		var obj = {id:$(this).val()};
		$.ajax({
			url: 'main.php',
			type: 'POST',
			data: obj,
			success: function(data){
				if(data){
				data = $.parseJSON(data);
				if('name' in data){
					var message = 'Ваш талон №'+data['name'];
					if ('speechSynthesis' in window) window.speechSynthesis.speak(new SpeechSynthesisUtterance(message))
					alert(message);
				}else{
					alert(data['error']);
				}
			}
		
		}
	});
	});
	});