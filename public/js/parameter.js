var select_val = 0;

//$(function() {
function init() {
	if(document.getElementById('citycode')){
		document.getElementById('citycode').selectedIndex = 0;
	}
	codeselChange();
}

function codeselChange(){
	if(document.getElementById('citycode')){
		select_val = document.getElementById('citycode').value;
	}else{
		select_val = parameters[0]['citycode'];
	}

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
			}
			var uf = parameters[i]['usefunction'];
			if(uf){
				for(var ii=0; ii < functions.length; i++){
					if(uf.substr(ii,1) == "1"){
						document.getElementById('usefunction' + functions[ii]['code2']).selected = true;
					}
				}
			}
			document.getElementById('usefunction').value = parameters[i]['usefunction'];
			document.getElementById('intpasscalss').value = parameters[i]['intpasscalss'];
			document.getElementById('intpass').value = parameters[i]['intpass'];
			break;
		}
	}

	intpasscalssChange();
}

function intpasscalssChange(){
	if(document.getElementById('intpasscalss').value == "2"){
		document.getElementById('intpass').disabled = false;
	}else{
		document.getElementById('intpass').disabled = true;
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
	}
	for(var ii=0; ii < functions.length; i++){
		if(document.getElementById('usefunction' + functions[ii]['code2']).selected){
			intpasscalss = intpasscalss + "1";
		}else{
			intpasscalss = intpasscalss + "0";
		}
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

function del() {
	bootbox.confirm({
	    message: document.getElementById('cityname').value + "のパラメタを削除しますか？",
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
	    				"citycode" : select_val,
	    				"_token" : _token
	    			}
	    		}).done(function (response) {
	    			if(response.status == "OK"){
	    				bootbox.alert({
	    					message: "削除しました",
	    					size: 'small',
	    					callback: function () {
	    						location.reload();
	    					}
	    				});
	    			}
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