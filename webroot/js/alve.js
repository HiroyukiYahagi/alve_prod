function reloadNavi(){
	$('ul#slide-out.side-nav.fixed').css('transform','none');
}

function alertRow(id){
    $('#tr_' + id).attr("class", "red lighten-4");
}

function successRow(id){
    $('#tr_' + id).attr("class", "");
}


$(function() {
	$('.sorter').tablesorter();

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




