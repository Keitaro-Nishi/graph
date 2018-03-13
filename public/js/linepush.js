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
	document.getElementById('region').disabled = bl;
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
	var region = document.getElementById('region').value;
	var sendmess = document.getElementById('sendmess').value;
	$.ajax({
		type: "POST",
		url: "linepushController.php",
		data: {
			"para" : para,
			"info" : info,
			"agek" : agek,
			"agem" : agem,
			"sex" : sex,
			"region" : region,
			"sendmess" : sendmess
		}
	}).done(function (response) {
		result = JSON.parse(response);
		if(result == "NG"){
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
		}else{
			if(para == "search"){
				document.getElementById('taisho').value = result;
			}
			if(para == "send"){
				bootbox.alert({
					message: "送信しました",
					size: 'small'
				});
			}
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
	var mess = "【送信対象】<br>　属性登録有無：" + document.getElementById('userinfo').options[document.getElementById('userinfo').selectedIndex].text;
	if(document.getElementById('age_kara').value == "999"){
		mess = mess + "<br>　　　対象年齢：" + document.getElementById('age_kara').options[document.getElementById('age_kara').selectedIndex].text;
	}else{
		mess = mess + "<br>　　　対象年齢：" + document.getElementById('age_kara').options[document.getElementById('age_kara').selectedIndex].text + "から" + document.getElementById('age_made').options[document.getElementById('age_made').selectedIndex].text;
	}
	mess = mess + "<br>　　　対象性別：" + document.getElementById('sex').options[document.getElementById('sex').selectedIndex].text;
	mess = mess + "<br>　　　対象地域：" + document.getElementById('region').options[document.getElementById('region').selectedIndex].text;
	mess = mess + "<br><br>上記の条件に該当する" + document.getElementById('taisho').value + "人にメッセージを送信しますか？";

	/*
	myRet = confirm(mess);
	if ( myRet == true ){
		postController("send");
	}
	*/
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