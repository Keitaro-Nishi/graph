var rowIds = [];
var selcode = "";

//$(function() {
function init() {

	$("#grid-basic").bootgrid({
		selection : true,
		multiSelect : true,
		keepSelection : true,
		columnSelection : false,
		formatters: {
	        "details": function($column, $row) {
	        	return "<input type='button' class='btn btn-default' value='修正' onclick='detailwin(\""  + $row.code12 + "\",\"" + $row.meisho + "\"," + $row.num + ")'> ";
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
}

function codeselChange(){
	var select_val = document.getElementById('codesel').value;

	//テーブル初期化
	$("#grid-basic").bootgrid("clear");
	rowIds = [];

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

function detailwin(code,meisho,num){
	selcode = code;
	document.getElementById('modal-label').innerHTML  = "コード修正";
	initmodal();
	document.getElementById('dia_meisho').value = meisho;
	document.getElementById('dia_num').value = num;
	document.getElementById("btn_modal").click();
}

function insert(){
	selcode = "";
	document.getElementById('modal-label').innerHTML  = "コード追加";
	initmodal();
	document.getElementById("btn_modal").click();
}

//ダイアログ初期化
function initmodal(){
	document.getElementById('dia_meisho').value = "";
	document.getElementById('dia_num').value = 0;
	//使用区分取得
	var class1 = 0;
	var select_val = document.getElementById('codesel').value;
	for(var i=0; i < tabledata.length; i++){
		if(tabledata[i]['code1'] == 0 && tabledata[i]['code2'] == select_val){
			class1 = tabledata[i]['class1'];
			break;
		}
	}
	if(class1 == 1){
		document.getElementById('dia_meisho_gp').style.display="block";
		document.getElementById('dia_num_gp').style.display="none";
	}else if(class1 == 2){
		document.getElementById('dia_meisho_gp').style.display="none";
		document.getElementById('dia_num_gp').style.display="block";
	}

	if(select_val == 0){
		document.getElementById('dia_kbn_gp').style.display="block";
	}else{
		document.getElementById('dia_kbn_gp').style.display="none";
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