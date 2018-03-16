function update(){
	var name = document.getElementById('dia_name').value;
	var oldpassword = document.getElementById('dia_oldpassword').value;
	var password = document.getElementById('dia_password').value;
	var password_confirmation = document.getElementById('dia_password_confirmation').value;
	var _token = document.getElementById('_token').value;
	console.log(_token);
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