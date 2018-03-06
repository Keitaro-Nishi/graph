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
//});

function codeselChange(){
    //var select_val = $('#codesel option:selected').val();
	var select_val = document.getElementById('codesel').value;
	alert("選択値:" + select_val);
	var codetable = document.getElementById('grid-basic');

	//テーブル初期化
	while( codetable.rows[ 1 ] ) codetable.deleteRow( 1 );

	//テーブルデータ作成
	for(var rec in tabledata){
		console.log(rec);
		//alert(rec['code1'] + ":" + rec['meisho']);
		if(rec['code1'] == select_val){
			var raw = codetable.insertRow( -1 );
			var td_code12 = raw.insertCell(-1),td_code1 = raw.insertCell(-1),td_code2 = raw.insertCell(-1),td_meisho = raw.insertCell(-1),td_num = raw.insertCell(-1),td_class1 = raw.insertCell(-1),td_class2 = raw.insertCell(-1);
			td_code12.innerHTML = rec['code1'] + "." + rec['code2'];
			td_code1.innerHTML = rec['code1'];
			td_code2.innerHTML = rec['code2'];
			td_meisho.innerHTML = rec['meisho'];
			td_num.innerHTML = rec['num'];
			td_class1.innerHTML = rec['class1'];
			td_class2.innerHTML = rec['class2'];
		}
	}

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