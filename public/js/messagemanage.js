var select_val = 0;

//$(function() {
function init() {
	document.getElementById('messid').selectedIndex = 0;
	messidChange();
}

function messidChange(){
	select_val = document.getElementById('messid').value;
	var messfind = false;

	//メッセージ検索
	for(var i=0; i < messages.length; i++){
		if(messages[i]['id'] == select_val){
			document.getElementById('mess').value = messages[i]['message'];
			messfind = true;
			break;
		}
	}

	if(!messfind){
		document.getElementById('mess').value = "";
	}
}

function update(){
	var message = document.getElementById('mess').value;
	var _token = document.getElementById('_token').value;
	$.ajax({
		type: "POST",
		dataType: "JSON",
		data: {
			"param" : "update",
			"id" : select_val,
			"message" : message,
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