$(document).ready(function(){


	var wrapper = $(".horarios-turno");

	var button = $(".add-field");

	var x = 1;

	$(button).click(function(e){
		e.preventDefault();
		$(wrapper).append("<div><div class='form-group col-lg-6'><label class='control-label col-lg-2' for='turnos_horarios'>Início</label><div class='col-lg-10'><input type='text' class='form-control' name='turnos_horarios[]'></div></div><div class='form-group col-lg-6'><label class='control-label col-lg-2' for='turnos_horarios'>Fim</label><div class='col-lg-10'><input type='text' class='form-control' name='turnos_horarios[]'></div></div><button class='remove-field btn btn-danger'><span class='glyphicon glyphicon-remove'></span></button></div>");
	});

	$(wrapper).on("click", ".remove-field", function(e){
		e.preventDefault();
		$(this).parent('div').remove();
	});

	$(wrapper).on("change paste keyup", ".form-control", function(){
		v = $(this).val();
		v = v.replace(/\D/g,"");
		v = v.replace(/(\d{2})(\d)/,"$1:$2");
		$(this).val(v);

	});

});