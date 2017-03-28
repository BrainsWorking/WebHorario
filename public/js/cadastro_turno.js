$(document).ready(function(){


	var flag = false;

	var inputs = $(".horarios-turno input").last();

	$(".horarios-turno input").attr('maxlength', '5');

	var input = $(".horarios-turno input").get(0)

	var html = $(".horarios-turno").html();

	$(".horarios-turno input").last().on("paste change", function(){
		flag = false;

		inputs.each(function(){
			
			if ($(this).val() != "" && $(this).closest(".horarios-turno input").val() != "") {
				flag = true;
			}else{
				flag = false;
			}
		});
		console.log(flag);
		if (flag) {
			$(".btn-success").before(html);
		};

	});

	$(".horarios-turno input").on("change paste keyup", function(){
		v = $(this).val();
		v = v.replace(/\D/g,"");
		v = v.replace(/(\d{2})(\d)/,"$1:$2");
		$(this).val(v);

	});

});