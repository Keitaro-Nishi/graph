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
		languageChange();
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

//言語変更
function languageChange(){
	var sex = document.getElementById('sex');
	while (0 < sex.childNodes.length) {
		sex.removeChild(sex.childNodes[0]);
	}
	//日本語
	if(document.getElementById('language').value == "01"){
		document.getElementById('label_language').innerHTML = "言語";
		document.getElementById('label_sex').innerHTML = "性別";
		setSelectValue(sex,"0","");
		setSelectValue(sex,"1","男性");
		setSelectValue(sex,"2","女性");
		document.getElementById('label_age').innerHTML = "年齢";
		optionSetting(codes);
	}

	//英語
	if(document.getElementById('language').value == "02"){
		document.getElementById('label_language').innerHTML = "Language";
		document.getElementById('label_sex').innerHTML = "Sex";
		setSelectValue(sex,"0","");
		setSelectValue(sex,"1","Male");
		setSelectValue(sex,"2","Female");
		document.getElementById('label_age').innerHTML = "Age";
		optionSetting(codesEn);
	}
}

function optionSetting(option_codes){
	for(var i = 1; i < 11; i++){
		if(document.getElementById('option'+i)){
			document.getElementById('label_option'+i).innerHTML = option_codes[i-1][0]["meisho"];
			var option = document.getElementById('option'+i);
			while (0 < option.childNodes.length) {
				option.removeChild(option.childNodes[0]);
			}
			for(var ii = 1; ii < option_codes[i-1].length; ii++){
				setSelectValue(option,option_codes[i-1][ii]["code2"],option_codes[i-1][ii]["meisho"]);
			}
		}
	}
}

function setSelectValue(select,value,text){
	var option = document.createElement('option');
	option.setAttribute('value', value);
	var intext = document.createTextNode(text);
	option.appendChild(intext);
	select.appendChild(option);
}

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