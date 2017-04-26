function atualizarAula() {

    let horario    = $(this).attr('data-horario')
    let semana     = $(this).attr('data-semana')
    let disciplina = $(this).val()
    let url = ROOT + '/fpa/'

    if(disciplina == ''){
        url += 'removerAula'
    } else{
        url += 'adicionarAula'
    }

    $.ajax({
        method: 'GET',
        url: url,
        data: {
            horario_id:    horario,
            disciplina_id: disciplina,
            diaSemana:        semana
        }
    }).fail((XHR, erro) => {
        console.log(erro)
        $(this).val('')
    }).done((XHR, msg, bla) => console.log(XHR))
}

$('.disciplina-fpa').change(atualizarAula)