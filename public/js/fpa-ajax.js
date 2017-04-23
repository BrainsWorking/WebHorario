'use strict'

function atualizarAula(el) {

    let horario    = el.attr('data-horario')
    let semana     = el.attr('data-semana')
    let disciplina = el.val()
    let url = ROOT + 'fpa/'

    if(disciplina == ''){
        url += 'removerAula'
    } else{
        url += 'adicionarAula'
    }

    $.ajax({
        method: 'POST',
        url: url,
        data: {
            horario_id:    horario,
            disciplina_id: disciplina,
            semana:        semana
        }
    }).fail((jqXHR, erro) => {
        alert(erro)
        el.val('')
    })
}