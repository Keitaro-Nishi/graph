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
	//alert(tabledata[0]['meisho']);
	document.getElementById('codesel').selectedIndex = 0;
	codeselChange();
}

function codeselChange(){
    //var select_val = $('#codesel option:selected').val();
	var select_val = document.getElementById('codesel').value;
	var codetable = document.getElementById('grid-basic');

	//テーブル初期化
	$("#grid-basic").bootgrid("clear");
	/*
	if(select_val == 1){
		var arr = [{"code12":"1.2","code1":"1","code2":"1","meisho":"テスト1","num":"3","class1":"4","class2":"5"}];
	}else{
		var arr = [{"code12":"1.2","code1":"1","code2":"2","meisho":"テスト2","num":"3","class1":"4","class2":"5"}];
	}
	*/
	//テーブルデータ作成
	var tblarray = [];
	for(var i=0; i < tabledata.length; i++){
		console.log(tabledata[i]['code1'] + ":" + tabledata[i]['meisho']);
		if(tabledata[i]['code1'] == select_val){
			tblarray.push({
				"code12":tabledata[i]['code1'] + "." + tabledata[i]['code2'],
				"code1":tabledata[i]['code1'],
				"code2":tabledata[i]['code2'],
				"meisho":tabledata[i]['meisho'],
				"num":tabledata[i]['num'],
				"class1":tabledata[i]['class1'],
				"class2":tabledata[i]['class2']
			});
		}
	}
	$("#grid-basic").bootgrid("append",tblarray);
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