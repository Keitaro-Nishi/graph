window.location.hash="#noback";
function init() {
	window.onhashchange=function(){
		window.location.hash="#noback";
	}
}

function update(){
	var name = document.getElementById('dia_name').value;
	var oldpassword = document.getElementById('dia_oldpassword').value;
	var password = document.getElementById('dia_password').value;
	var password_confirmation = document.getElementById('dia_password_confirmation').value;
	var _token = document.getElementById('_token').value;

	$.ajax({
		type: "POST",
		dataType: "JSON",
		data: {
			"name" : name,
			"oldpassword" : oldpassword,
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
				message: "現在のパスワードが間違っています。",
				size: 'small',
			});
		}else if(response.status == "BACK"){
			bootbox.alert({
				message: "パスワードに変更がありません。",
				size: 'small',
			});
		}else if(response.status == "LOGOUT"){
			bootbox.alert({
				message: "ログアウトします。新しいパスワードでログインしてください。",
				size: 'small',
				callback: function () {
					location.replace("/login");
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