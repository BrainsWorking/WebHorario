$(document).ready(function(){
    var wrapper = $(".disciplinas");
    var button = $(".add-field");
    var i = 2;

    $(wrapper).on("click", ".add-field", function(adiciona_disciplina){
        $(this).closest(wrapper).append(`
         <div id="disciplina">
            <div class="control-group form-group col-sm-5">
                <input name="nome[semestre1][]" type="text" class="form-control" required>
            </div>
            <div class="control-group form-group col-sm-2">                     
                <input name="sigla[semestre1][]" type="text" class="form-control" required maxlength="5">
            </div>
            <div class="control-group form-group col-sm-2">                     
                <select class="form-control" name="tipoSala[semestre1][]">
                    <option>Sala Comum</option>
                    <option>Laboratório de Informática</option>
                </select>
            </div>              
            <div class="control-group form-group col-sm-2">
                <input name="aulasSemanais[semestre1][]" type="text" class="form-control" required>
            </div>
            <div class="col-sm-1 remove-field">
                <button type="button" class="btn btn-danger btn-sm right">
                <span class="glyphicon glyphicon-remove"></span>
                </button>
            </div> 
         </div>`);
    });

    $(wrapper).on("click", ".remove-field", function(remove_disciplina){
        e.preventDefault();
        $(this).parent().remove();
    });

    $(".modulo").on('click', '#add-semestre', function(adiciona_semestre){
        e.preventDefault()
        $("#last").before(`
         <li><a data-toggle='pill' href='#semestre`+ i +`'>` + i + `° Semestre</a></li>
         `);

        $('.tab-content').append(`
            <div id="semestre`+ i +`" class="disciplinas tab-pane fade in active">
                <div class="control-group" style="margin-left: 15px;">
                    <button type="button" class="btn btn-success add-field">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar outras disciplinas
                    </button>
                </div>
                <div class="control-group form-group col-sm-5">
                    <label for='nome' class='control-label'>Nome</label>
                    <input name="nome[`+i+`][]" type="text" class="form-control" required>
                </div>
                <div class="control-group form-group col-sm-2">
                    <label for='sigla' class='control-label'>Sigla</label>
                    <input name="sigla[`+i+`][]" type="text" class="form-control" required maxlength="5">
                </div>
                <div class="control-group form-group col-sm-2">
                    <label for='tipoSala' class='control-label'>Tipo Sala</label>
                    <select class="form-control" name="tipoSala[`+i+`][]">
                        <option>Sala Comum</option>
                        <option>Laboratório de Informática</option>
                    </select>
                </div>              
                <div class="control-group form-group col-sm-2">
                    <label for='aulasSemanais' class='control-label'>Aulas/Semana</label>
                    <input name="aulasSemanais[`+i+`][]" type="text" class="form-control" required>
                </div>                  
            </div>
        `);
        
        i++;
    });

});