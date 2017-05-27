$(document).ready(function(){

	verifica_aulas_professores();
	classifica_professores();


	$('.professor').change(function(){
		$('.carga-semanal').text('0');
		verifica_aulas_professores();
	});

	function verifica_aulas_professores(){
		$('.professor option:selected').each(function(index, el) {
			var professor_nome = $(this).text();
			var aulas_disciplina = $(this).parent().siblings('.aula-semana').children('span').text();

			$('.atrb-professor').each(function(index, el) {
				if ($(this).find('.professor-nome').text() == professor_nome) {
					var aulas_atuais = $(this).find('.carga-semanal').text();
					var aulas_atualizadas = parseInt(aulas_atuais) + parseInt(aulas_disciplina);
					$(this).find('.carga-semanal').text(aulas_atualizadas);
				};
			});

		});
	}

	function classifica_professores(){
		//classificar os professores na lista por ordem decrescente de quantidade de aulas
	}

	//aplicar classe de warning para professores com baixa quantidade de aula de acordo com média.

	//arrumar metodo de loop para gerar abas;

});