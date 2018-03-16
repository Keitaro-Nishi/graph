function update(){
	var userid = document.getElementById('dia_userid').value;
	var password = document.getElementById('dia_password').value;
	var password_confirmation = document.getElementById('dia_password_confirmation').value;
	var _token = document.getElementById('_token').value;
	$.ajax({
		type: "POST",
		dataType: "JSON",
		data: {
			"userid" : userid,
			"password" : password,
			"password_confirmation" : password_confirmation,
			"_token" : _token
		}
	}).done(function (response) {
		bootbox.alert({
			message: "更新しました",
			size: 'small',
			callback: function () {
				location.reload();
			}
		});
	}).fail(function () {
		bootbox.alert({
			message: "更新できませんでした",
			size: 'small'
		});
	});
}