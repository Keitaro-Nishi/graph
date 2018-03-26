function init(){
	if(userinfo["updkbn"] == "1"){
		document.getElementById('language').value = userinfo["language"];
		languageChange();
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

//言語変更
function languageChange(){
	//selectedIndex退避
	var sex_Sidx = document.getElementById('sex').selectedIndex;
	var option_Sidx = [];
	for(var i = 1; i < 11; i++){
		if(document.getElementById('option'+i)){
			option_Sidx.push(document.getElementById('option'+i).selectedIndex);
		}else{
			option_Sidx.push(0);
		}
	}
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
		document.getElementById('btn_del').value = "　削除　";
		document.getElementById('btn_update').value = "　登録　";
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
		document.getElementById('btn_del').value =    "   Delete   ";
		document.getElementById('btn_update').value = "Registration";
	}

	//selectedIndex設定
	document.getElementById('sex').selectedIndex = sex_Sidx;
	for(var i = 1; i < 11; i++){
		if(document.getElementById('option'+i)){
			document.getElementById('option'+i).selectedIndex = option_Sidx[i-1];
		}
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
			setSelectValue(option,"0","");
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
	var okmess = "";
	var ngmess = "";
	if(document.getElementById('language').value == "01"){
		okmess = "登録しました。<br>画面を閉じてください。";
		ngmess = "登録できませんでした";
	}
	if(document.getElementById('language').value == "02"){
		okmess = "Has registered.<br>Please close the screen.";
		ngmess = "Registration failed.";
	}
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
			message: okmess,
			size: 'small',
		});
    }).fail(function () {
    	bootbox.alert({
			message: ngmess,
			size: 'small'
		});
    });
}

//削除
function del(){
	var confmess = "";
	var okmess = "";
	var ngmess = "";
	var yes = "";
	var no = "";
	if(document.getElementById('language').value == "01"){
		confmess = "登録されている属性を削除しますか？";
		okmess = "削除しました。<br>画面を閉じてください。";
		ngmess = "削除できませんでした";
		yes = "はい";
		no = "いいえ";
	}
	if(document.getElementById('language').value == "02"){
		confmess = "Delete registered attributes?";
		okmess = "It has been deleted.<br>Please close the screen.";
		ngmess = "Delete failed.";
		yes = "YES";
		no = "NO";
	}
	bootbox.confirm({
	    message: confmess,
	    buttons: {
	    	confirm: {
	            label: '<i class="fa fa-check"></i> ' + yes
	        },
	        cancel: {
	            label: '<i class="fa fa-times"></i> ' + no
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
	        			message: okmess,
	        			size: 'small',
	        		});
	            }).fail(function () {
	            	bootbox.alert({
	        			message: ngmess,
	        			size: 'small'
	        		});
	            });
	        }
	    }
	});
}