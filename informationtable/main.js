$(document).ready(function(){
	String.prototype.replaceAt = function(index, replacement) {
  return this.substr(0, index) + replacement + this.substr(index + replacement.length);
}


	var idtickets = [];
	var idcall = [];
	var checkcall = [];
	var checkidtickets = [];
	getTickets();
	setInterval(function(){
		getTickets();
	}, 1000);
	function getTickets(){
		$.ajax({
			url: 'main.php',
			type: 'POST',
			success: function(data){
				if(data){
					data = $.parseJSON(data);
					if('wait' in data){
						for(var i = 0; i<data['wait'].length; i++){
						checkidtickets.push(data['wait'][i].id);
						if($.inArray(data['wait'][i].id, idtickets) == -1){
							idtickets.push(data['wait'][i].id);
							$('.information').append('<div id="'+data['wait'][i].id+'"">'+data['wait'][i].name+'</div>');
						}
					}
					for(var i = 0; i<idtickets.length; i++){
						if($.inArray(idtickets[i],checkidtickets) == -1){
							$('.information #'+idtickets[i]).remove();
						}
					}
					checkidtickets = [];
				}else{
					$('.information').empty();
				}
				if('call' in data){
					for(var i = 0; i<data['call'].length; i++){
						checkcall.push(data['call'][i].id);
						if($.inArray(data['call'][i].id, idcall) == -1){
							var message = 'Талон № '+ data['call'][i].name+' пройдите к '+data['call'][i].window.replaceAt(3,'у');
							if ('speechSynthesis' in window) window.speechSynthesis.speak(new SpeechSynthesisUtterance(message));
							idcall.push(data['call'][i].id);
							$('.call').append('<div id="'+data['call'][i].id+'"">'+data['call'][i].name+' → '+data['call'][i].window+'</div>');

						}
					}
					for(var j = 0; j<idcall.length; j++){
						if($.inArray(idcall[j],checkcall) == -1){
							$('.call #'+idcall[j]).remove();
						}
					}
					checkcall = [];

				}else{
					$('.call').empty();
				}
					
				}else{
					$('.information').empty();
					$('.call').empty();
				}
				
			}
		
		});
	}
	}); 