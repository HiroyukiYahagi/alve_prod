

function reloadNavi(){
	console.log('reload');
	$('ul#slide-out.side-nav.fixed').css('transform','none');
}

$(function() {
	$('#sorter').tablesorter();

	$('.button-collapse').sideNav({
		menuWidth: 240,
		edge: 'left',
	});

	$('select').material_select();

	$('.datepicker').pickadate({
	    selectMonths: true,
	    selectYears: 15,
	});

	$('.modal-trigger').leanModal();

	$('.submit').click(function() {
	  $(this).parents('form').attr('action', $(this).data('action'));
	  $(this).parents('form').submit();
	});
	
});




