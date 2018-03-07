var rowIds = [];
var dbvalue = [];
var shosai_idx = 0;

botlog= document.getElementById('botlog').value;
dbvalue = JSON.parse(botlog);

$(function() {
	$("#grid-basic").bootgrid({
		selection : true,
		multiSelect : true,
		keepSelection : true,
		formatters: {
			"details": function($column, $row) {
				return "<input type='button' class='btn btn-default' value='詳細' onclick='detailwin("  + $row.no + ")'> ";
			}
		}
	}).on("selected.rs.jquery.bootgrid", function(e, rows) {
		for (var i = 0; i < rows.length; i++) {
			rowIds.push(rows[i].no);
		}
	}).on("deselected.rs.jquery.bootgrid", function(e, rows) {
		for (var i = 0; i < rows.length; i++) {
			rowIds.some(function(v, ii) {
				if (v == rows[i].no)
					rowIds.splice(ii, 1);
			});
		}
	});
});
function drow() {
	if(rowIds.length == 0){
		alert("削除する行を選択してください");
		return;
	}
	var successFlg = true;
	var myRet = confirm("選択行を削除しますか？");
	if ( myRet == true ){
		for (var i = 0; i < rowIds.length; i++){
			$.ajax({
				type: "GET",
				url: 'botlog/'+ rowIds[i],
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

function detailwin(value){
	document.getElementById("btn_modal").click();
	for (var i = 0; i < dbvalue.length; i++){
		if(dbvalue[i][0] == value){
			shosai_idx = i;
			modal_mod(i);
		}
	}
}

function shosai_back(){
	shosai_idx = shosai_idx - 1;
	modal_mod(shosai_idx);
}
function shosai_next(){
	shosai_idx = shosai_idx + 1;
	modal_mod(shosai_idx);
}

function modal_mod(index){
	document.getElementById('dia_no').value = dbvalue[index]["no"];
	document.getElementById('dia_userid').value  = dbvalue[index]["userid"];
	document.getElementById('dia_time').value = dbvalue[index]["time"];
	document.getElementById('dia_contents').value  = dbvalue[index]["contents"];
	document.getElementById('dia_return').value  = dbvalue[index]["return"];
	if(index == 0){
		document.getElementById("sback").disabled = "true";
	}else{
		document.getElementById("sback").disabled = "";
	}
	if(index == dbvalue.length - 1){
		document.getElementById("snext").disabled = "true";
	}else{
		document.getElementById("snext").disabled = "";
	}
}
