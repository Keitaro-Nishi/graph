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
		}
		else if(response.status == "NG"){
			bootbox.alert({
				message: "現在のパスワードが違います。",
				size: 'small',
				callback: function () {
					location.reload();
				}
			});
		}
	}).fail(function () {
		bootbox.alert({
			message: "更新できませんでした",
			size: 'small'
		});
	});
}