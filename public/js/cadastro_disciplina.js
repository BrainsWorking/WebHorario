$(document).ready(function(){


    var wrapper = $(".disciplinas");

    var button = $(".add-field");

    var x = 1;

    $(button).click(function(e){
        e.preventDefault();
        $(wrapper).append(
			'<div class="row">' +
				'<div class="col-sm-12">' +
					'<div class="form-group col-sm-8">' +
						'<input type="text" name="nome['+x+']" class="form-control" required>' +
					'</div>' +
					'<div class="form-group col-sm-3">' +
						'<input type="text" name="iniciais['+x+']" class="form-control" maxlength="5" required>' +
					'</div>' +
            		'<div class="col-sm-1 remove-field">' +
            			'<button type="button" class="btn btn-danger btn-sm right">' +
            				'<span class="glyphicon glyphicon-remove"></span>' +
            			'</button>' +
            		'</div>' +
				'</div>' +
			'</div>');
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
        //v = $(this).val();
       // v = v.replace(/\D/g,"");
        //v = v.replace(/(\d{2})(\d)/,"$1:$2");
        //$(this).val(v);

    });

});