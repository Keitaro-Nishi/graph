var select_val = 0;

//$(function() {
function init() {
	document.getElementById('messid').selectedIndex = 0;
	messidChange();
}

function messidChange(){
	select_val = document.getElementById('messid').value;

	//メッセージ検索
	for(var i=0; i < messages.length; i++){
		if(messages[i]['id'] == select_val){
			document.getElementById('mess').value = messages[i]['message'];
		}
	}
}

function update(){
	/*
	var cityCD = "";
	if(document.getElementById('citycd')){
		cityCD = document.getElementById('citycd').value;
	}
	var meisho = document.getElementById('dia_meisho').value;
	var num = document.getElementById('dia_num').value;
	var class1 = "0";
	if(document.getElementsByName('kbn')[0].checked){
		class1 = "1";
	}
	if(document.getElementsByName('kbn')[1].checked){
		class1 = "2";
	}
	class2 = document.getElementById('dia_hkbn').value;
	var _token = document.getElementById('_token').value;
	console.log("select_val:" + select_val + " selcode:" + selcode + " meisho" + meisho + " num:" + num + " class1:" + class1 + " class2:" + class2 + " _token:" + _token);
	$.ajax({
		type: "POST",
		dataType: "JSON",
		data: {
			"param" : "update",
			"citycode" : cityCD,
			"code1" : select_val,
			"selcode" : selcode,
			"meisho" : meisho,
			"num" : num,
			"class1" : class1,
			"class2" : class2,
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
    */
}