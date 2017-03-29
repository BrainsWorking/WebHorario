$(document).ready(function(){


	var wrapper = $(".horarios-turno");

	var button = $(".add-field");

	var x = 2;

	$(button).click(function(e){
		e.preventDefault();
		$(wrapper).append('<div class="row"><div class="col-lg-1 padding-left-0"><label class="index">Aula '+ x +'</label></div><div class="col-lg-10"><div class="form-group col-lg-6"><input type="text" name="turnos_horarios[]" class="form-control" placeholder="Início" maxlength="5" required></div><div class="form-group col-lg-6"><input type="text" name="turnos_horarios[]" class="form-control" placeholder="Fim" maxlength="5" required></div></div><div class="col-lg-1 padding-right-0 remove-field"><button type="button" class="btn btn-danger btn-sm right"><span class="glyphicon glyphicon-remove"></span></button></div></div>');
		x++;
	});

	$(wrapper).on("click", ".remove-field", function(e){
		e.preventDefault();
		$(this).parent().remove();

		labels = $('.index');
		for (var i = 0; i <= x; i++) {
			$(labels[i]).html("Aula " + (i + 1));
		};
		x--;
	});

	$(wrapper).on("change paste keyup", ".form-control", function(){
		v = $(this).val();
		v = v.replace(/\D/g,"");
		v = v.replace(/(\d{2})(\d)/,"$1:$2");
		$(this).val(v);

	});

});