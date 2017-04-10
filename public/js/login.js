$(document).ready(function(){
	var icon = $('.input-group-addon');

	$(icon).mousedown(function(){
		$('.senha').attr('type', 'text');
	});

	$(icon).mouseup(function(){
		$('.senha').attr('type', 'password');
	});
});