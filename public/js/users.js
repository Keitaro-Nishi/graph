var rowIds = [];
$(function() {
	$("#grid-basic").bootgrid({
		selection : true,
		multiSelect : true,
		keepSelection : true,
		columnSelection : false,
		formatters: {
	        "details": function($column, $row) {
	        	return "<input type='button' class='btn btn-default' value='修正' onclick='detail(\"" $row.name + "\",\"" + $row.userid + "\",\"" + $row.organization + "\",\"" + $row.citycode + "\")' > ";
	        	//return "<input type='button' class='btn btn-default' value='修正' onclick='detail('1','1','1','1','1')' > ";
             }
	    }
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

function detail(name,userid,organization,citycode,password){
	document.getElementById('modal-label').innerHTML  = "ユーザー情報修正";
	/*
	if(document.getElementById('dia_citycode')){
		document.getElementById('dia_citycode').value = citycode;
		document.getElementById('dia_citycode').disabled = true;
	}
	document.getElementById('dia_userid').value = userid;
	document.getElementById('dia_userid').disabled = true;
	document.getElementById('dia_name').value = name;
	//document.getElementById('dia_organization').selectedIndex = 0;
	document.getElementById('dia_password').value = password;
	document.getElementById('dia_password_confirmation').value = password;
	*/
	document.getElementById("btn_modal").click();

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
		document.getElementById('dia_citycode').disabled = false;
	}
	document.getElementById('dia_userid').value = "";
	document.getElementById('dia_userid').disabled = false;
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
	var username = document.getElementById('dia_name').value;
	var organization = document.getElementById('dia_organization').value;
	var password = document.getElementById('dia_password').value;
	var password_confirmation = document.getElementById('dia_password_confirmation').value;
	var _token = document.getElementById('_token').value;
	$.ajax({
		type: "POST",
		dataType: "JSON",
		data: {
			"citycode" : citycode,
			"userid" : userid,
			"username" : username,
			"organization" : organization,
			"password" : password,
			"password_confirmation" : password_confirmation,
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
		}else if(response.status == "NG"){
			bootbox.alert({
				message: "更新できませんでした",
				size: 'small'
			});
		}else{
			var mes = "";
			for (var item in response) {
				if(mes != ""){
					mes = mes + "<br>";
				}
			    mes = mes + response[item][0];
			}
			bootbox.alert({
				message: mes,
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