var rowIds = [];
$(function() {
	$("#grid-basic").bootgrid({
		selection : true,
		multiSelect : true,
		rowSelect : true,
		keepSelection : true
	}).on("selected.rs.jquery.bootgrid", function(e, rows) {
		for (var i = 0; i < rows.length; i++) {
			rowIds.push(rows[i].userid);
		}
	}).on("deselected.rs.jquery.bootgrid", function(e, rows) {
		for (var i = 0; i < rows.length; i++) {
			rowIds.some(function(v, ii) {
				if (v == rows[i].userid)
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
				type: "DELETE",
				url: 'users/'+ rowIds[i],
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

function insert(){
	document.getElementById('modal-label').innerHTML  = "ユーザー登録";
	initmodal();
	document.getElementById("btn_modal").click();
}

//ダイアログ初期化
function initmodal(){
	document.getElementById('dia_citycode').value = "";
	document.getElementById('dia_userid').value = "";
	document.getElementById('dia_name').value = "";
	document.getElementById('dia_organization').selectedIndex = 0;
	document.getElementById('dia_password').value = "";
	document.getElementById('dia_password-confirm').value = "";
}