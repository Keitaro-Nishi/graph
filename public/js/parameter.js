var select_val = 0;

//$(function() {
function init() {
	document.getElementById('citycode').selectedIndex = 0;
	codeselChange();
}

function codeselChange(){
	select_val = document.getElementById('citycode').value;

	//パラメタ検索
	for(var i=0; i < parameters.length; i++){
		if(parameters[i]['citycode'] == select_val){
			if(document.getElementById('citycode')){
				document.getElementById('cityname').value = parameters[i]['cityname'];
				document.getElementById('line_cat').value = parameters[i]['line_cat'];
				document.getElementById('cvs_ws_id1').value = parameters[i]['cvs_ws_id1'];
				document.getElementById('cvs_ws_id2').value = parameters[i]['cvs_ws_id2'];
				document.getElementById('cvs_ws_id3').value = parameters[i]['cvs_ws_id3'];
				document.getElementById('cvs_ws_id4').value = parameters[i]['cvs_ws_id4'];
				document.getElementById('cvs_ws_id5').value = parameters[i]['cvs_ws_id5'];
				document.getElementById('usefunction').value = parameters[i]['usefunction'];
			}
			document.getElementById('intpasscalss').value = parameters[i]['intpasscalss'];
			document.getElementById('intpass').value = parameters[i]['intpass'];
			break;
		}
	}
}

function update(){
	var citycode = "";
	var cityname = "";
	var line_cat = "";
	var cvs_ws_id1 = "";
	var cvs_ws_id2 = "";
	var cvs_ws_id3 = "";
	var cvs_ws_id4 = "";
	var cvs_ws_id5 = "";
	var usefunction = "";
	var intpasscalss = "";
	var intpass = "";
	if(document.getElementById('citycode')){
		citycode = document.getElementById('citycode').value;
		cityname = document.getElementById('cityname').value;
		line_cat = document.getElementById('line_cat').value;
		cvs_ws_id1 = document.getElementById('cvs_ws_id1').value;
		cvs_ws_id2 = document.getElementById('cvs_ws_id2').value;
		cvs_ws_id3 = document.getElementById('cvs_ws_id3').value;
		cvs_ws_id4 = document.getElementById('cvs_ws_id4').value;
		cvs_ws_id5 = document.getElementById('cvs_ws_id5').value;
		usefunction = document.getElementById('usefunction').value;
	}
	var intpasscalss = document.getElementById('intpasscalss').value;
	var intpass = document.getElementById('intpass').value;
	var _token = document.getElementById('_token').value;
	$.ajax({
		type: "POST",
		dataType: "JSON",
		data: {
			"param" : "update",
			"citycode" : citycode,
			"cityname" : cityname,
			"line_cat" : line_cat,
			"cvs_ws_id1" : cvs_ws_id1,
			"cvs_ws_id2" : cvs_ws_id2,
			"cvs_ws_id3" : cvs_ws_id3,
			"cvs_ws_id4" : cvs_ws_id4,
			"cvs_ws_id5" : cvs_ws_id5,
			"usefunction" : usefunction,
			"intpasscalss" : intpasscalss,
			"intpass" : intpass,
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

function insert(){
	var citycode = document.getElementById('dia_citycode').value;
	var cityname = document.getElementById('dia_cityname').value;
	var _token = document.getElementById('_token').value;
	$.ajax({
		type: "POST",
		dataType: "JSON",
		data: {
			"param" : "insert",
			"citycode" : citycode,
			"cityname" : cityname,
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