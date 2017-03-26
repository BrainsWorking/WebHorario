$(document).ready(function(){

	var html = "Teste";

	var flag = false;

	var inputs = $(".horarios-turno input");

	$(".horarios-turno input").bind("paste keyup", function(){
		flag = false;

		inputs.each(function(){
			
			if ($(this).val() != "" && $(this).closest(".horarios-turno input").val() != "") {
				flag = true;
			}else{
				flag = false;
			}
		});

		if (flag) {
			$(html).insertBefore('button');
		};

	});


});