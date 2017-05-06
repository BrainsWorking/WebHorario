$(document).ready(function(){

    $(".chosen-select").chosen({
        no_results_text: "Nenhuma disciplina encontrada!",
        width: '100%',
        allow_single_deselect: true 
    });

    if($("input:radio[name='regimeTrabalho']:checked").val() == "40"){
        $("#div-prioridade").fadeIn('slow');
    }

    $("#regimeTrabalho input[name='regimeTrabalho']").click(function(){
        if($("input:radio[name='regimeTrabalho']:checked").val() == "40"){
            $("#div-prioridade").fadeIn('slow');
        }else{
            $("#div-prioridade").fadeOut('slow');
            $("input:checkbox[name='prioridade']").prop('checked', false);
        }
    });
    
    $(".form").submit(function(e){
        var disponibilidade = $(".fpa-checkbox:checked").length;

        if($("input:radio[name='regimeTrabalho']:checked").val() == "40"){
            if(disponibilidade < 29){
                e.preventDefault(e);
                qnt = 29
                return bootbox.alert(
                    "Você precisa selecionar ao menos 29 horários <br \> selecionados: " + disponibilidade
                );
            }
        }else{
            if(disponibilidade < 18){
                e.preventDefault(e);
                qnt = 18
                return bootbox.alert(
                    "Você precisa selecionar ao menos 18 horários <br \> selecionados: " + disponibilidade
                );
            }
        }
    });
    
});