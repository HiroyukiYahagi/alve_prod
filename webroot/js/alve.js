

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
	    selectMonths: true, // Creates a dropdown to control month
	    selectYears: 15 // Creates a dropdown of 15 years to control year
	});

	
});
