$(document).ready(function(){
	$('.confirmar').on('click', function (e) {
		e.preventDefault();
		href = $(this).attr('href');
		return bootbox.confirm({
			title: "Atenção",
			message: "Deseja realmente excluir?",
			buttons: {
				confirm: {
					label: 'Sim',
					className: 'btn-success'
				},
				cancel: {
					label: 'Não',
					className: 'btn-danger'
				}
			},
			callback: function (result) {
				if(result)
					window.location = href
			}
		});
	});
});