var rowIds = [];

$(function() {
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
	document.getElementById('codesel').selectedIndex = 0;
	codeselChange();
});

function codeselChange(){
	// 選択した値を取得
    var select_val = $('#codesel option:selected').val();
    alert(select_val);

    // tbodyのtr数回 処理をする
    $.each($("#grid-basic tbody tr"), function (index, element) {

    	alert(element);

        var row_text = $(element).code1;

        if (row_text == select_val) {
            $(element).css("display", "table-row");
        } else {
            $(element).css("display", "none");
        }

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