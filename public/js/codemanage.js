var rowIds = [];

//$(function() {
function init() {
	$("#grid-basic").bootgrid({
		selection : true,
		multiSelect : true,
		keepSelection : true,
		columnSelection : false,
		formatters: {
	        "details": function($column, $row) {
	        	return "<input type='button' class='btn btn-default' value='修正' onclick='detailwin("  + $row.code12 + ")'> ";
             }
	    }
	}).on("selected.rs.jquery.bootgrid", function(e, rows) {
		for (var i = 0; i < rows.length; i++) {
			rowIds.push(rows[i].code12);
		}
	}).on("deselected.rs.jquery.bootgrid", function(e, rows) {
		for (var i = 0; i < rows.length; i++) {
			rowIds.some(function(v, ii) {
				if (v == rows[i].code12)
					rowIds.splice(ii, 1);
			});
		}
	});

	//テーブル操作
	alert(tabledata[0]);
	document.getElementById('codesel').selectedIndex = 0;
	//codeselChange();
}
//});

function codeselChange(){
    var select_val = $('#codesel option:selected').val();
    alert(select_val);

    $('#grid-basic').find('tr').hide().each(function(){
        var tr = $(this);
        alert($(this).find('td')[1].text());
        if($(this).find('td')[1].text() == select_val){
        	tr.show();
        }
        /*
        $(this).find('td').each(function(){
            if ($(this)[].text().match(regExp)) {
                tr.show();
            }
        })
        */
    });

}

function drow() {
	if(rowIds.length == 0){
		bootbox.alert({
			message: "削除する行を選択してください",
			size: 'small'
		});
		return;
	}
	var successFlg = true;
	var myRet = confirm("選択行を削除しますか？");
	if ( myRet == true ){
		for (var i = 0; i < rowIds.length; i++){
			$.ajax({
				type: "GET",
				url: 'ajax/'+ rowIds[i],
			}).then(
				function(){
				},
				function(){
					successFlg = false;
				}
			);
		}
		if( successFlg == true){
			alert("削除しました");
			location.reload();
		}else{
			alert("削除できませんでした");
		}
	}
}