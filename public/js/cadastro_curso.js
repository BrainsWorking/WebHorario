$(document).ready(function(){

    $('.modulos').on("click", ".add-field", function(){
        var close = $(this).closest('.disciplinas');
        var index = close.attr('id');
        var i = close.attr('data-modulo');

        console.log(index);
        console.log(i);
        
        close.append(`
         <div class="disciplina">
            <div class="control-group form-group col-sm-3">
                <input name="modulo_novo[`+ i +`][disciplinas][nome][]" type="text" class="form-control" required>
            </div>
            <div class="control-group form-group col-sm-2">                     
                <input name="modulo_novo[`+ i +`][disciplinas][sigla][]" type="text" class="form-control" required maxlength="5">
            </div>
            <div class="control-group form-group col-sm-2">                     
                <select class="form-control" name="modulo_novo[`+ i +`][disciplinas][tipo_sala][]">
                    <option>Sala Comum</option>
                    <option>Laboratório de Informática</option>
                </select>
            </div>              
            <div class="control-group form-group col-sm-2">
                <input name="modulo_novo[`+ i +`][disciplinas][aulas_semanais][]" type="text" class="form-control" required>
            </div>
            <div class="control-group form-group col-sm-2">
                <input name="modulo_novo[`+ i +`][disciplinas][quantidade_professores][]" type="text" class="form-control" required>
            </div>
            <div class="col-sm-1 remove-field">
                <button type="button" class="btn btn-danger btn-sm right">
                <span class="glyphicon glyphicon-remove"></span>
                </button>
            </div> 
         </div>`);
    });

    $('.modulos').on("click", ".remove-field", function(){
        $(this).parent().remove();
    });

    $(".modulos").on('click', '#add-semestre', function(){
        i++;
        $('.nav-tabs>li.active').removeClass('in active');
        $('.tab-content>.active').removeClass('in active');        
        $("#last").before(`
         <li class="active"><a data-toggle='pill' href='#semestre`+ i +`'>` + i + `° Semestre</a></li>
         `);

        $('.tab-content').append(`
            
            <div id="semestre`+ i +`" class="disciplinas tab-pane fade in active" data-modulo = `+i+`>
                <input type="hidden" name="modulo_novo[`+ i +`][nome]" value="`+i+`º Semestre" hidden/>
                <div class="control-group" style="margin-left: 15px;">
                    <button type="button" class="btn btn-success add-field">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar outras disciplinas
                    </button>
                    <button type="button" data-target="semestre`+ i +`" class="btn btn-default remove-semestre" style="float: right; margin-top: 10px;">
                        <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> Remover este semestre
                    </button>
                </div>
                <div class="disciplina">
                    <div class="control-group form-group col-sm-3">
                        <label for='nome' class='control-label'>Nome</label>
                        <input name="modulo_novo[`+ i +`][disciplinas][nome][]" type="text" class="form-control" required>
                    </div>
                    <div class="control-group form-group col-sm-2">
                        <label for='sigla' class='control-label'>Sigla</label>
                        <input name="modulo_novo[`+ i +`][disciplinas][sigla][]" type="text" class="form-control" required maxlength="5">
                    </div>
                    <div class="control-group form-group col-sm-2">
                        <label for='tipoSala' class='control-label'>Tipo Sala</label>
                        <select class="form-control" name="modulo_novo[`+ i +`][disciplinas][tipo_sala][]">
                            <option>Sala Comum</option>
                            <option>Laboratório de Informática</option>
                        </select>
                    </div>
                    <div class="control-group form-group col-sm-2">
                        <label for='aulas_semanais' class='control-label'>Aulas/Semana</label>
                        <input name="modulo_novo[`+ i +`][disciplinas][aulas_semanais][]" type="text" class="form-control" required>
                    </div>
                    <div class="control-group form-group col-sm-2">
                        <label for='quantidade_professores' class='control-label'>Qtd Professores</label>
                        <input name="modulo_novo[`+ i +`][disciplinas][quantidade_professores][]" type="text" class="form-control" required>
                    </div>
                </div>
            </div>
        `);
    });

    $('.modulos').on("click", ".remove-semestre", function(){
        var referencia = '#' + $(this).attr('data-target');
        console.log(referencia);
        var link_referencia = 'a[href="'+referencia+'"]';
        $(link_referencia).parent().remove();
        $(referencia).remove();
        $('div[id^=semestre]').each(function(index, el) {
            $(el).attr('id', 'semestre'+(index+1));
            $(el).attr('data-modulo', (index+1));
            $(el).find('input[name$="[nome]"]').attr('value', (index+1) + '° Semestre');
            $(el).find('input[name$="[nome]"]').attr('name', 'modulo_novo['+(index+1) + '][nome]');
            $(el).find('.remove-semestre').attr('data-target', 'semestre'+(index+1));
            $(el).find('input[name$="[disciplinas][nome][]"]').attr('name', 'modulo_novo['+(index+1)+'][nome][]');
            $(el).find('input[name$="[disciplinas][sigla][]"]').attr('name', 'modulo_novo['+(index+1)+'][disciplinas][sigla][]');
            $(el).find('select[name$="[disciplinas][tipo_sala][]"]').attr('name', 'modulo_novo['+(index+1)+'][disciplinas][tipo_sala][]');
            $(el).find('input[name$="[disciplinas][aulas_semanais][]"]').attr('name', 'modulo_novo['+(index+1)+'][disciplinas][aulas_semanais][]');
        });
        $('a[href^="#semestre"]').each(function(index, el) {
            $(el).attr('href', '#semestre' + (index+1));
            $(el).html((index+1) + '° Semestre');
        });
        referencia = '#semestre' + (i-2);
        if ($('#last').prev('li').length >= 1) {
            $('.tab-content>.active').removeClass('in active');
            $('#last').prev('li').addClass('active');
            $(referencia).addClass('active in');
        }else{
            $('.tab-content>.active').removeClass('in active');
            // $('#last').addClass('active');
            // $('#dp').addClass('active in'); 
        }
        if (i > 1) {
            i--;
        };
    });
});