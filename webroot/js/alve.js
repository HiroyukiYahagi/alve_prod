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
    if(confirm("製品を削除してよろしいですか?\n一度削除を実行すると復元できません。\n必要な場合は、CSVで保存をお願いします。\n削除を実行してよろしいですか?")) {
	    location.href = $(this).attr('href');
	} else {
	    return false;
	}
}

function confirmEdit(){
    if(confirm("登録済の製品を編集する場合、上書きで保存されます。\n元の登録内容が必要な場合は、CSVで保存してください。\n編集を開始しますか?")) {
        location.href = $(this).attr('href');
    } else {
        return false;
    }    
}

function confirmDeleteForm(){
    if(confirm("評価を削除してよろしいですか?\n一度削除を実行すると復元できません。\n必要な場合は、CSVで保存をお願いします。\n削除を実行してよろしいですか?")) {
        location.href = $(this).attr('href');
    } else {
        return false;
    }
}

function confirmEditForm(){
    if(confirm("登録済のしくみ評価を編集する場合、上書きで保存されます。\n元の登録内容が必要な場合は、CSVで保存してください。\n編集を開始しますか?")) {
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

	$(".datepicker").pickadate({
        monthsFull:  ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"],
        monthsShort: ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"],
        weekdaysFull: ["日曜日", "月曜日", "火曜日", "水曜日", "木曜日", "金曜日", "土曜日"],
        weekdaysShort:  ["日", "月", "火", "水", "木", "金", "土"],
        weekdaysLetter: ["日", "月", "火", "水", "木", "金", "土"],
        labelMonthNext: "翌月",
        labelMonthPrev: "前月",
        labelMonthSelect: "月を選択",
        labelYearSelect: "年を選択",
        today: "今日",
        clear: "クリア",
        close: "閉じる",
        format: "yyyy-mm-dd",
        selectMonths: true,
	    selectYears:20,
    });

	$('.modal-trigger').leanModal();

	$('.submit').click(function() {
	  $(this).parents('form').attr('action', $(this).data('action'));
	  $(this).parents('form').submit();
	});

});

$(document).ready(function() {
    jQuery.each($('input[required]'), function(index, val) {
    	if($(val).val().length == 0){
    		$(val).addClass('invalid');
    	}    	
    });
    $('input.picker__input').change(function(event) {
        if($(this).val().length != 0){
            $(this).removeClass('invalid');
        } 
    });
});



