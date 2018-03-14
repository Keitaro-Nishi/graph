var rowIds = [];
var updateKbn = false;
function init() {
	$("#grid-basic").bootgrid({
		selection : true,
		multiSelect : true,
		keepSelection : true,
		columnSelection : false,
		formatters: {
			"details": function($column, $row) {
				return "<input type='button' class='btn btn-default' value='修正' onclick='detail(\"" + $row.name + "\",\"" + $row.userid + "\",\"" + $row.organization + "\",\"" + $row.citycode + "\")' > ";
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
}

function drow() {
	if(rowIds.length == 0){
		bootbox.alert({
			message: "削除する行を選択してください",
			size: 'small'
		});
		return;
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
						"userids" : rowIds,
						"_token" : _token
					}
				}).done(function (response) {
					bootbox.alert({
						message: "削除しました",
						size: 'small',
						callback: function () {
							location.reload();
						}
					});
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

function detail(name,userid,organization,citycode){
	updateKbn = true;
	document.getElementById('modal-label').innerHTML  = "ユーザー情報修正";
	initmodal();
	if(document.getElementById('dia_citycode')){
		document.getElementById('dia_citycode').value = citycode;
		document.getElementById('dia_citycode').disabled = true;
	}
	document.getElementById('dia_userid').value = userid;
	document.getElementById('dia_userid').disabled = true;
	document.getElementById('dia_name').value = name;
	document.getElementById('dia_organization').value = organization;
	document.getElementById('dia_passres').style.display="block";
	document.getElementById('dia_passresck').checked = false;
	document.getElementById('dia_password').disabled = true;
	document.getElementById('dia_password_confirmation').disabled = true;
	document.getElementById('dia_info').style.display="none";
	document.getElementById("btn_modal").click();

}

function insert(){
	updateKbn = false;
	document.getElementById('modal-label').innerHTML  = "ユーザー登録";
	initmodal();
	document.getElementById('dia_passresck').checked = true;
	document.getElementById('dia_passres').style.display="none";
	switch (intpass['intpasscalss']){
	//ユーザーＩＤ
	case "1":
		document.getElementById('dia_info').style.display="block";
		document.getElementById('dia_infolabel').innerHTML  = "※パスワードにはユーザーＩＤが設定されます";
		document.getElementById('dia_password').disabled = true;
		document.getElementById('dia_password_confirmation').disabled = true;
		break;
		//一括設定
	case "2":
		document.getElementById('dia_info').style.display="block";
		document.getElementById('dia_infolabel').innerHTML  = "※パスワードにはパラメタ設定にて登録した値が設定されます";
		document.getElementById('dia_password').disabled = true;
		document.getElementById('dia_password_confirmation').disabled = true;
		break;
		//個別設定
	case "3":
		document.getElementById('dia_info').style.display="none";
		break;
	}
	document.getElementById("btn_modal").click();
}

//ダイアログ初期化
function initmodal(){
	if(document.getElementById('dia_citycode')){
		document.getElementById('dia_citycode').selectedIndex = 0;
		document.getElementById('dia_citycode').disabled = false;
	}
	document.getElementById('dia_userid').value = "";
	document.getElementById('dia_userid').disabled = false;
	document.getElementById('dia_name').value = "";
	document.getElementById('dia_organization').selectedIndex = 0;
	document.getElementById('dia_password').disabled = false;
	document.getElementById('dia_password_confirmation').disabled = false;
	document.getElementById('dia_password').value = "";
	document.getElementById('dia_password_confirmation').value = "";
}

function preset(){
	if(document.getElementById('dia_passresck').checked){
		switch (intpass['intpasscalss']){
		//ユーザーＩＤ
		case "1":
			document.getElementById('dia_info').style.display="block";
			document.getElementById('dia_infolabel').innerHTML  = "※再設定パスワードにはユーザーＩＤが設定されます";
			break;
			//一括設定
		case "2":
			document.getElementById('dia_info').style.display="block";
			document.getElementById('dia_infolabel').innerHTML  = "※再設定パスワードにはパラメタ設定にて登録した値が設定されます";
			break;
			//個別設定
		case "3":
			document.getElementById('dia_password').disabled = false;
			document.getElementById('dia_password_confirmation').disabled = false;
			break;
		}
	}else{
		document.getElementById('dia_password').disabled = true;
		document.getElementById('dia_password_confirmation').disabled = true;
		switch (intpass['intpasscalss']){
		//ユーザーＩＤ
		case "1":
			document.getElementById('dia_info').style.display="none";
			break;
			//一括設定
		case "2":
			document.getElementById('dia_info').style.display="none";
			break;
		}
	}
}

function update(){
	var citycode = "00000";
	if(document.getElementById('dia_citycode')){
		citycode = document.getElementById('dia_citycode').value;
	}
	var userid = document.getElementById('dia_userid').value;
	var username = document.getElementById('dia_name').value;
	var organization = document.getElementById('dia_organization').value;
	var passreset = document.getElementById('dia_passresck').checked;
	var password = "";
	var password_confirmation = "";
	switch (intpass['intpasscalss']){
	//ユーザーＩＤ
	case "1":
		password = document.getElementById('dia_userid').value;
		password_confirmation = document.getElementById('dia_userid').value;
		break;
		//一括設定
	case "2":
		password = intpass['intpass'];
		password_confirmation = intpass['intpass'];
		break;
		//個別設定
	case "3":
		password = document.getElementById('dia_password').value;
		password_confirmation = document.getElementById('dia_password_confirmation').value;
		break;
	}
	var _token = document.getElementById('_token').value;
	$.ajax({
		type: "POST",
		dataType: "JSON",
		data: {
			"param" : "update",
			"updateKbn" : updateKbn,
			"citycode" : citycode,
			"userid" : userid,
			"username" : username,
			"organization" : organization,
			"passreset" : passreset,
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