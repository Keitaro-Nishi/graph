var rowIds = [];
var rowcl2s = [];
var selcode = "";
var select_val = 0;
var class1 = "0";
var class2 = "0";

//$(function() {
function init() {

	$("#grid-basic").bootgrid({
		selection : true,
		multiSelect : true,
		keepSelection : true,
		columnSelection : false,
		formatters: {
	        "details": function($column, $row) {
	        	return "<input type='button' class='btn btn-default' value='修正' onclick='detailwin(\""  + $row.code12 + "\",\"" + $row.meisho + "\"," + $row.num + ",\"" + $row.class1 + "\",\"" + $row.class2 + "\")'> ";
             }
	    }
	}).on("selected.rs.jquery.bootgrid", function(e, rows) {
		for (var i = 0; i < rows.length; i++) {
			rowIds.push(rows[i].code12);
			rowcl2s.push(rows[i].class2);
		}
	}).on("deselected.rs.jquery.bootgrid", function(e, rows) {
		for (var i = 0; i < rows.length; i++) {
			rowIds.some(function(v, ii) {
				if (v == rows[i].code12)
					rowIds.splice(ii, 1);
					rowcl2s.splice(ii, 1);
			});
		}
	});

	//テーブル操作
	document.getElementById('codesel').selectedIndex = 0;
	codeselChange();
}

function codeselChange(){
	codeselval = document.getElementById('codesel').value.split('.');
	select_val = codeselval[0];
	class1 = codeselval[1];
	class2 = codeselval[2];

	//テーブル初期化
	$("#grid-basic").bootgrid("clear");
	rowIds = [];
	rowcl2s = [];

	//テーブルデータ作成
	var tblarray = [];
	for(var i=0; i < tabledata.length; i++){
		if(tabledata[i]['code1'] == select_val){
			if(class1 == "1"){
				tblarray.push({
					"code12":tabledata[i]['code1'] + "." + tabledata[i]['code2'],
					"code1":tabledata[i]['code1'],
					"code2":tabledata[i]['code2'],
					"meisho":tabledata[i]['meisho'],
					"num":tabledata[i]['num'],
					"value":tabledata[i]['meisho'],
					"class1":tabledata[i]['class1'],
					"class2":tabledata[i]['class2']
				});
			}else if(class1 == "2"){
				tblarray.push({
					"code12":tabledata[i]['code1'] + "." + tabledata[i]['code2'],
					"code1":tabledata[i]['code1'],
					"code2":tabledata[i]['code2'],
					"meisho":tabledata[i]['meisho'],
					"num":tabledata[i]['num'],
					"value":tabledata[i]['num'],
					"class1":tabledata[i]['class1'],
					"class2":tabledata[i]['class2']
				});
			}
		}
	}
	$("#grid-basic").bootgrid("append",tblarray);
}

function detailwin(code,meisho,num,cl1,cl2){
	selcode = code;
	document.getElementById('modal-label').innerHTML  = "コード修正";
	initmodal();
	document.getElementById('dia_meisho').value = meisho;
	document.getElementById('dia_num').value = num;
	if(cl1 == "1"){
		document.getElementsByName('kbn')[0].checked = true;
		document.getElementsByName('kbn')[1].checked = false;
	}else if(cl1 == "2"){
		document.getElementsByName('kbn')[0].checked = false;
		document.getElementsByName('kbn')[1].checked = true;
	}
	document.getElementById('dia_hkbn').value = cl2;
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

	if(class1 == "1"){
		document.getElementById('dia_meisho_gp').style.display="block";
		document.getElementById('dia_num_gp').style.display="none";
		document.getElementsByName('kbn')[0].checked = true;
		document.getElementsByName('kbn')[1].checked = false;
	}else if(class1 == "2"){
		document.getElementById('dia_meisho_gp').style.display="none";
		document.getElementById('dia_num_gp').style.display="block";
		document.getElementsByName('kbn')[0].checked = false;
		document.getElementsByName('kbn')[1].checked = true;
	}

	document.getElementById('dia_hkbn').value = class2;

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
	for(var value in rowcl2s){
		if(value == 2){
			bootbox.alert({
				message: "削除できない行が含まれています",
				size: 'small'
			});
			return;
		}
	}
	bootbox.confirm({
	    message: "選択行を削除しますか？",
	    buttons: {
	    	confirm: {
	            label: '<i class="fa fa-check"></i> はい'
	        },
	        cancel: {
	            label: '<i class="fa fa-times"></i> いいえ'
	        }
	    },
	    callback: function (result) {
	        if(result){
	        	var _token = document.getElementById('_token').value;
	        	$.ajax({
	    			type: "POST",
	    			dataType: "JSON",
	    			data:{
	    				"param" : "delete",
	    				"codes" : rowIds,
	    				"_token" : _token
	    			}
	    		}).done(function (response) {
	    			if(response.status == "OK"){
	    				bootbox.alert({
	    					message: "削除しました",
	    					size: 'small',
	    					callback: function () {
	    						location.reload();
	    					}
	    				});
	    			}
	    	    }).fail(function () {
	    	    	bootbox.alert({
	    				message: "削除できませんでした",
	    				size: 'small'
	    			});
	    	    });
	        }
	    }
	});
}

function update(){
	var meisho = document.getElementById('dia_meisho').value;
	var num = document.getElementById('dia_num').value;
	var class1 = "0";
	if(document.getElementsByName('kbn')[0].checked){
		class1 = "1";
	}
	if(document.getElementsByName('kbn')[1].checked){
		class1 = "2";
	}
	class2 = document.getElementById('dia_hkbn').value;
	var _token = document.getElementById('_token').value;
	console.log("select_val:" + select_val + " selcode:" + selcode + " meisho" + meisho + " num:" + num + " class1:" + class1 + " class2:" + class2 + " _token:" + _token);
	$.ajax({
		type: "POST",
		dataType: "JSON",
		data: {
			"param" : "update",
			"code1" : select_val,
			"selcode" : selcode,
			"meisho" : meisho,
			"num" : num,
			"class1" : class1,
			"class2" : class2,
			"_token" : _token
		}
	}).done(function (response) {
		if(response.status == "OK"){
			bootbox.alert({
				message: "更新しました",
				size: 'small',
				callback: function () {
					location.reload();
				}
			});
		}else{
			bootbox.alert({
				message: "更新できませんでした",
				size: 'small'
			});
		}
    }).fail(function () {
    	bootbox.alert({
			message: "更新できませんでした",
			size: 'small'
		});
    });
}