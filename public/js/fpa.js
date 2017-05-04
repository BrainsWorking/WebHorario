$(".chosen-select").chosen({
    no_results_text: "Nenhuma disciplina encontrada!",
    width: '100%',
    allow_single_deselect: true 
});

$(document).ready(function(){
    'use strict'
    var wrapper = $(".escolha-disciplinas");
    var button = $(".add-field");
    var x = $('.index').length + 1;

    $(button).click(function(e){
        e.preventDefault();
        $(wrapper).append(`
            <div class="row">
                <div class="col-lg-2">
                    <label class="index">Disciplina ` + x + `</label>
                </div>
                <div class="form-group col-lg-4">
                    <select name="componentes[]" class="chosen-select" data-placeholder=" ">
                        <option value=''></option>
                        @foreach($disciplinas as $disciplina)
                            <option value="{{$disciplina['id']}}">{{$disciplina['nome']}}</option>
                        @endforeach
                        <!--optgroup label="ADS">
                        </optgroup -->
                    </select>
                </div>
                <div class="col-lg-1 padding-right-0 remove-field">
                    <button type="button" class="btn btn-danger btn-sm">
                        <span class="glyphicon glyphicon-remove"></span>
                    </button>
                </div>
            </div>
        `);

        $(".chosen-select").chosen({
            no_results_text: "Nenhuma disciplina encontrada!",
            width: '100%',
            allow_single_deselect: true 
        });
        x++;
    });

    $(wrapper).on("click", ".remove-field", function(e){
        e.preventDefault();
        $(this).parent().remove();

        var labels = $('.index');
        for (var i = 0; i <= x; i++) {
            $(labels[i]).html("Disciplina " + (i + 1));
        };
        x--;
    });
});