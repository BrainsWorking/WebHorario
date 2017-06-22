$(document).ready(function(){

	conta_aulas_professores();
	classifica_professores();
	verifica_media_aulas();


	$('.professor').change(function(){
		console.log($(this).val());
		$('.carga-semanal').text('0');
		conta_aulas_professores();
		classifica_professores();
		verifica_media_aulas($(this).val());
	});

	function conta_aulas_professores(){
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
		var lista_atribuição = $('.atrb-professor');
		lista_atribuição.sort(function(a, b){
			return parseInt($(b).find('.carga-semanal').text()) - 
					parseInt($(a).find('.carga-semanal').text()); 

		});
		$('#atrb-professores').html(lista_atribuição);
	}

	function verifica_media_aulas(nome){
		$('.atrb-professor').removeClass('atrb-warning');
		$('.atrb-professor').removeClass('atrb-danger');
		var total_aulas = 0;
		console.log($(this));
		
		$('.atrb-professor').each(function(index, el) {
			total_aulas = total_aulas + parseInt($(this).find('.carga-semanal').text());
			
		});
		console.log(total_aulas);
		var media = total_aulas / $('.atrb-professor').length;
		$('.atrb-professor').each(function(index, el) {
			var aulas_professor = parseInt($(this).find('.carga-semanal').text())
			if (aulas_professor < media) {
				console.log($(this));
				$("$atrb-professores").prepend(nome);
				$(this).addClass('atrb-warning');	
			};
		});
	}
});
