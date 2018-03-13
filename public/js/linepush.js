$(function(){
	taishoDisabled(true);
	//taishocount();
});

//属性登録有無チェンジ
function userinfoChange(){
	if(document.getElementById('userinfo').value == 1){
		taishoDisabled(false);
	}else{
		taishoDisabled(true);
	}
	//taishocount();
}

//対象年齢からチェンジ
function agekChange(){
	if(document.getElementById('age_kara').value == "999"){
		document.getElementById('age_kigo').style.display = "none";
		document.getElementById('age_made').style.display = "none";
	}else{
		document.getElementById('age_kigo').style.display = "block";
		document.getElementById('age_made').style.display = "block";
	}
	//taishocount();
}

//対象年齢までチェンジ
function agemChange(){
	//taishocount();
}

//対象性別チェンジ
function sexChange(){
	//taishocount();
}

//対象地域チェンジ
function regionChange(){
	//taishocount();
}

function taishoDisabled(bl){
	document.getElementById('age_kara').disabled = bl;
	document.getElementById('age_made').disabled = bl;
	document.getElementById('sex').disabled = bl;
	for(var i = 1; i < 11; i++){
		if(document.getElementById('option'+i)){
			document.getElementById('option'+i).disabled = bl;
		}
	}
}

//対象人数の調査
function taishocount(){
	postController("search");
}

//ControllerにPOST
function postController(para){
	var info = document.getElementById('userinfo').value;
	var agek = document.getElementById('age_kara').value;
	var agem = document.getElementById('age_made').value;
	var sex = document.getElementById('sex').value;
	var option = [];
	for(var i = 1; i < 11; i++){
		if(document.getElementById('option'+i)){
			option.push(document.getElementById('option'+i).value);
		}else{
			option.push(0);
		}
	}
	var sendmess = document.getElementById('sendmess').value;
	var _token = document.getElementById('_token').value;
	$.ajax({
		type: "POST",
		dataType: "JSON",
		data: {
			"param" : para,
			"info" : info,
			"agek" : agek,
			"agem" : agem,
			"sex" : sex,
			"option" : option,
			"sendmess" : sendmess,
			"_token" : _token
		}
	}).done(function (response) {
		if(para == "search"){
			document.getElementById('taisho').value = response.hitcount;
		}
		if(para == "send"){
			bootbox.alert({
				message: "送信しました",
				size: 'small'
			});
		}
    }).fail(function () {
    	if(para == "search"){
    		bootbox.alert({
				message: "対象者数を取得できませんでした",
				size: 'small'
			});
    	}
    	if(para == "send"){
    		bootbox.alert({
				message: "送信できませんでした",
				size: 'small'
			});
		}
    });
}

//送信
function send(){
	if (document.getElementById('taisho').value == 0){
		bootbox.alert({
			message: "送信対象者が存在しません",
			size: 'small'
		});
		return;
	}
	if (!document.getElementById('sendmess').value.match(/\S/g)){
		bootbox.alert({
			message: "送信内容が入力されていません",
			size: 'small'
		});
		return;
	}
	var mess = "【送信対象】<br>属性登録有無：" + document.getElementById('userinfo').options[document.getElementById('userinfo').selectedIndex].text;
	if(document.getElementById('age_kara').value == "999"){
		mess = mess + "<br>年齢：" + document.getElementById('age_kara').options[document.getElementById('age_kara').selectedIndex].text;
	}else{
		mess = mess + "<br>年齢：" + document.getElementById('age_kara').options[document.getElementById('age_kara').selectedIndex].text + "から" + document.getElementById('age_made').options[document.getElementById('age_made').selectedIndex].text;
	}
	mess = mess + "<br>性別：" + document.getElementById('sex').options[document.getElementById('sex').selectedIndex].text;
	for(var i = 1; i < 11; i++){
		if(document.getElementById('option'+i)){
			option.push(document.getElementById('option'+i).value);
			mess = mess + "<br>" + document.getElementById('optionlabel'+i).innerText + "：" + document.getElementById('option'+i).options[document.getElementById('option'+i).selectedIndex].text;
		}
	}
	mess = mess + "<br><br>上記の条件に該当する" + document.getElementById('taisho').value + "人にメッセージを送信しますか？";

	bootbox.confirm({
	    message: mess,
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
	        	postController("send");
	        }
	    }
	});
}