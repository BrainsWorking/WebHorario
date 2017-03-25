$(document).ready(function(){


	//TOGGLE DE INFORMAÇÕES EXTRAS / DROPDOWN DE INFORMAÇÕES EXTRAS
	$(".table-more-info").click(function(){
		if ($(this).hasClass('open')) {
			$(this).removeClass('open');
			$(this).children().attr("class", "glyphicon glyphicon-chevron-down");
		}else{
			$(this).children().attr("class", "glyphicon glyphicon-chevron-up");
			$(this).addClass("open");
		}
		$(this).parent().next().toggle('fast');
	});

	$(".input-filter").bind("paste keyup", function(){
		var filter = $(this).val().toUpperCase();
		
		$('.table-line').each(function(){
			var search = $(this).children(".search");
			search.each(function(){

				if(! $(this).html().toUpperCase().includes(filter)){
					if ($(this).parent().hasClass('show')) {
						$(this).parent().hide();
					};
				}else{
					$(this).parent().addClass('show');
					$(this).parent().show();
				}
			});
		});

	});
});