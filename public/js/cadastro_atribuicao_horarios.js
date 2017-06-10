$(document).ready(function(){

	conta_aulas_disciplinas();
	verifica_limites_aula();

	$('.disciplina').change(function(){
		$('.carga-semanal').text('0');
		conta_aulas_disciplinas();
		verifica_limites_aula();
	});

	function conta_aulas_disciplinas(){
		$('.disciplina option:selected').each(function(index, el) {
			var disciplina_nome = $(this).text();
			var aulas_disciplina = $(this).parent().siblings('.aula-semana').children('span').text();

			$('.atrb-disciplina').each(function(index, el) {
				if ($(this).find('.disciplina-nome').text() == disciplina_nome) {
					var aulas_atuais = $(this).find('.carga-semanal').text();
					var aulas_atualizadas = parseInt(aulas_atuais) + 1;
					$(this).find('.carga-semanal').text(aulas_atualizadas);
				};
			});

		});
	}

	function verifica_limites_aula(){
		$('.atrb-disciplina').removeClass('atrb-warning');
		$('.atrb-disciplina').removeClass('atrb-danger');
		$('.atrb-disciplina').removeClass('atrb-success');
		$('#form-salvar').removeAttr('disabled');
		$('#form-continuar').removeAttr('disabled');
		var total_aulas = 0;
		$('.atrb-disciplina').each(function(index, el) {
			total_aulas = parseInt($(this).find('.carga-semanal').text());
			total_disciplina = parseInt($(this).find('.carga-disciplina').text());
			if (total_aulas < total_disciplina) {
				$(this).addClass('atrb-warning');
				$('#form-salvar').attr('disabled', '');
			}else{
				if (total_aulas > total_disciplina) {
					$(this).addClass('atrb-danger');
					$('#form-continuar').attr('disabled', '');
				}else{
					$(this).addClass('atrb-success');
				}
			}
			
		});
	}
});