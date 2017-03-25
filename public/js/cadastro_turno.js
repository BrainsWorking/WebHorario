$(document).ready(function(){

	var flag = false;

	$(".horarios-turno input").bind("paste keyup", function(){
		var flag = false;
		$(this).each(function(){
			if ($(this).val() != "") {
				flag = true;
			}else{
				flag = false;
			}
		})

		console.log(flag)
	});

});