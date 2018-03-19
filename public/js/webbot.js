$(function(){
	var url = 'https://api.github.com/search/repositories?q=';
	var msgIndex, key;
	var botui = new BotUI('chat-app');
	//var user = "webtest";
	var language = "";
	var sex = "0";
	var age = "999";
	var region = "";
	var search = "";
	var message = "";
	var sexN = "";
	var citycode ="";
	var userid ="";
	var userinfo = [];



	citycode= document.getElementById('citycode').value;
	userid= document.getElementById('userid').value;




	  //初期メッセージ
	  botui.message.bot({
	    content: 'こんにちは！'
	  }).then(init);

	  function init() {
		  botui.message.bot({
			  delay: 1500,  //メッセージの表示タイミングをずらす
		      content: 'はじめにテストするボットを選択してください'
		  }).then(function() {
		      return botui.action.button({
		        delay: 1000,
		        action: [{
		          text: '属性登録',
		          value: '属性登録'
		        }, {
		          text: '検診相談',
		          value: '検診相談'
		        }, {
		          text: 'その他のお問い合わせ',
			      value: 'その他のお問い合わせ'
		        }]
		      });
		  }).then(function(res) {
			  switch (res.value){
			  case '属性登録':
				message = 'それでは、以下のリンクより属性登録をお願いします。';
				attribute();
			    break;
			  case '検診相談':
				kenshin();
			    break;
			  case 'その他のお問い合わせ':
				sonota();
			    break;
			}
		  })
	  }

	  function attributeSearch(){
		  var _token = document.getElementById('_token').value;

		  $.ajax({
			  type: "POST",
				dataType: "JSON",
				data: {
					"param" : "search",
					"citycode" : citycode,
					"userid" : userid,
					"sender" : 2,
					"_token" : _token
				}
		  }).done(function(response){
			language = response.language;
	      	sex = response.sex;
	      	age = response.age;

	      	kenshin2();

		  }).fail(function(){
			  alert("エラーが発生しました。");
		  });
	   }


	  //属性登録
	  function attribute(){
		  botui.message.bot({
			  delay: 1000,
			  content: message
		  }).then(function() {
			  var url = "";
			  var attrurl = "";

			  url = location.href + "/" + citycode + "/" + 2 + "/" +userid;
			  attrurl = url.replace( /webbot/g , "attribute" );

			  /*if (lang == "02"){
				  attrurl = "https://gyoseibot.herokuapp.com/attribute_en.php?user=";
			  }else{
				  attrurl = "https://gyoseibot.herokuapp.com/attribute.php?user=";
			  }*/

			  if(age < 10){
					age = "00" + age;
				}else{
					if(age < 100){
						age = "0" + age;
					}
			  }
			  botui.message.add({
			        delay: 1000,
			        //content: '[属性登録](' + attrurl + user.substr(0, 1) + sex + user.substr(1, 1) + age + user.substr(2, 1) + region + user.substr(3) + ')^'
			        content: '[属性登録](' + attrurl +')^'
			  });
		  }).then(init);
	  }


	  //検診相談
	  function kenshin(){
		  //属性登録チェック
		  attributeSearch();
	  }


	  function kenshin2(){

		  if(sex == "0" || age == "999"){
			  message = '申し訳ありませんが、先に以下のリンクより属性登録をお願いします。';
			  attribute();
			  return;
		  }
		  if(sex == "1"){
			sexN = "男";
		  }
		  if(sex == "2"){
			sexN = "女";
		  }

		  callWatson("1", "0", age + "の" + sexN);
		  botui.message.bot({
			  delay: 1000,
			  content: message
		  }).then(function() {
			  return botui.action.text({
			        delay: 1000,
			        action: {
			          placeholder: '入力してください'
			        }
			  });
		  }).then(function(res) {
			  kenshin3(res);
		  })

	  }

	  //検診相談続き
	  function kenshin3(res){
		  callWatson("1", "1", res.value);
		  botui.message.bot({
			  delay: 1000,
			  content: message
		  }).then(function() {
			  return botui.action.text({
			        delay: 1000,
			        action: {
			          placeholder: '入力してください'
			        }
			  });
		  }).then(function(res) {
			  kenshin2(res);
		  })
	  }


	  //その他のお問い合わせ
	  function sonota(){
		  callWatson("2", "0", "初回発話");
		  botui.message.bot({
			  delay: 1000,
			  content: message
		  }).then(function() {
			  return botui.action.text({
			        delay: 1000,
			        action: {
			          placeholder: '入力してください'
			        }
			  });
		  }).then(function(res) {
			  sonota2(res);
		  })
	  }

	//その他のお問い合わせ続き
	  function sonota2(res){
		  callWatson("2", "1", res.value);
		  botui.message.bot({
			  delay: 1000,
			  content: message
		  }).then(function() {
			  return botui.action.text({
			        delay: 1000,
			        action: {
			          placeholder: '入力してください'
			        }
			  });
		  }).then(function(res) {
			  sonota2(res);
		  })
	  }



	  //Watson呼び出し
	  function callWatson(param, kbn, text){
		  var param = param;
		  var kbn = kbn;
		  var text = text;

		  var _token = document.getElementById('_token').value;

			$.ajax({
				type: "POST",
				dataType: "JSON",
				data:{
					"param" : "watson",
					"user" : userid,
					"paramdata" : param,
					"kbn" : kbn,
					"text" : text,
					"_token" : _token
				}
	            crossDomain: false,
	            scriptCharset: 'utf-8',
	            async: false
	        }).done(function(response){
	        	message = response.text;
	        	alert("成功")
	        }).fail(function(XMLHttpRequest, textStatus, errorThrown){
	            alert(errorThrown);
	        });
	  }


});

function dispclear(){
	location.reload();
}
