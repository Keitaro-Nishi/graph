function init(){
	if(userinfo["updkbn"] == "1"){
		document.getElementById('language').value = userinfo["language"];
		document.getElementById('sex').value = userinfo["sex"];
		document.getElementById('age').value = userinfo["age"];
		for(var i = 1; i < 11; i++){
			if(document.getElementById('option'+i)){
				document.getElementById('option'+i).value = userinfo["param" + i];
			}
		}
	}else{
		document.getElementById('language').selectedIndex = 0;
		document.getElementById('sex').selectedIndex = 0;
		document.getElementById('age').selectedIndex = 0;
		for(var i = 1; i < 11; i++){
			if(document.getElementById('option'+i)){
				document.getElementById('option'+i).selectedIndex = 0;
			}
		}
	}
};


//更新
function update(){
	var language = document.getElementById('language').value;
	var sex = document.getElementById('sex').value;
	var age = document.getElementById('age').value;
	var option = [];
	for(var i = 1; i < 11; i++){
		if(document.getElementById('option'+i)){
			option.push(document.getElementById('option'+i).value);
		}else{
			option.push(0);
		}
	}
	var _token = document.getElementById('_token').value;
	$.ajax({
		type: "POST",
		dataType: "JSON",
		data: {
			"param" : "update",
			"language" : language,
			"sex" : sex,
			"age" : age,
			"option" : option,
			"_token" : _token
		}
	}).done(function (response) {
		bootbox.alert({
			message: "登録しました。<br>画面を閉じてください。",
			size: 'small',
		});
    }).fail(function () {
    	bootbox.alert({
			message: "登録できませんでした",
			size: 'small'
		});
    });
}

//削除
function del(){
	bootbox.confirm({
	    message: "登録されている属性を削除しますか？",
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
	        		data: {
	        			"param" : "delete",
	        			"_token" : _token
	        		}
	        	}).done(function (response) {
	        		bootbox.alert({
	        			message: "削除しました。<br>画面を閉じてください。",
	        			size: 'small',
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