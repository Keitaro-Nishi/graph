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
	if(document.getElementById('dia_citycode')){
		document.getElementById('dia_citycode').value = "";
	}
	document.getElementById('dia_userid').value = "";
	document.getElementById('dia_name').value = "";
	document.getElementById('dia_organization').selectedIndex = 0;
	document.getElementById('dia_password').value = "";
	document.getElementById('dia_password_confirmation').value = "";
}

function update(){
	var citycode = "00000";
	if(document.getElementById('dia_citycode')){
		citycode = document.getElementById('dia_citycode').value;
	}
	var userid = document.getElementById('dia_userid').value;
	var name = document.getElementById('dia_name').value;
	var organization = document.getElementById('dia_organization').value;
	var password = document.getElementById('dia_password').value;
	var password_confirmation = document.getElementById('dia_password_confirmation').value;
	var _token = document.getElementById('_token').value;
	$.ajax({
		type: "POST",
		//url: "/user",
		dataType: "JSON",
		data: {
			"citycode" : citycode,
			"userid" : userid,
			"name" : name,
			"organization" : organization,
			"password" : password,
			"password_confirmation" : password_confirmation,
			"_token" : _token
		}
	}).done(function (response) {
		alert("1-1");
		result = "";
		//result = JSON.parse(response);
		alert("1-2");
		alert(response);
		if(result == "OK"){
			alert("更新しました");
			location.reload();
		}else{
			alert("1更新できませんでした");
		}
    }).fail(function () {
    	alert("2-1");
    	alert(result);
        alert("2更新できませんでした");
    });
}