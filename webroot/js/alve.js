function reloadNavi(){
	$('ul#slide-out.side-nav.fixed').css('transform','none');
}

function alertRow(id){
    $('#tr_' + id).attr("class", "red lighten-4");
}

function successRow(id){
    $('#tr_' + id).attr("class", "");
}

function confirmDelete(){
    if(confirm("データを削除しますがよろしいですか？")) {
	    location.href = $(this).attr('href');
	} else {
	    return false;
	}
}

function confirmSend(){
    if(confirm("通知メールが送信されます。よろしいですか？")) {
	    location.href = $(this).attr('href');
	} else {
	    return false;
	}
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




