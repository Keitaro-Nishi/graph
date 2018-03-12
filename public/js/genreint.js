var bunrui = 0;
var gid1 = 0;
var gid2 = 0;
var meisho = "";
var meishoOld = "";
var uiKbn = 0;
var g1meisho = "";
var rowIds = [];
var rowgid1 = [];
var rowgid2 = [];
var wtable = document.getElementById('grid-basic');
$(function(){

	//テーブル追加
	getwtint();

	/*
	var wtable = document.getElementById('grid-basic');
	var raw = wtable.insertRow( -1 );
	var td1 = raw.insertCell(-1),td2 = raw.insertCell(-1);
	td1.innerHTML = "テスト";
	td2.innerHTML = '<input type="button" value="行削除" onclick="delLine(this)" />';
	*/
});

//インテント取得
function getwtint(){
	g1meisho = document.getElementById('g1').value;
	var _token = document.getElementById('_token').value;

	$.ajax({
		type: "POST",
		dataType: "JSON",
		data: {
			"param" : "intentSearch",
			"g1meisho" : g1meisho,
			"g2meisho" : "",
			"sword" : "",
			"_token" : _token
		}
	}).done(function (response) {
		console.log(response);
		//result = JSON.parse(response);
		for( var i =0, i < response.length; i++ ) {
			var raw = wtable.insertRow( -1 );
			var td1 = raw.insertCell(-1),td2 = raw.insertCell(-1);
			td2.style.width = "50px";
			console.log(response[i]);
			td1.innerHTML = response[i];
			td2.innerHTML = '<input type="button" value="削除" class="btn btn-default" onclick="delLine(\'' + response[i] + '\',this)" />';
			//alert("成功");
		}
    }).fail(function () {
        alert("Watsonデータの取得に失敗しました");
    });
}

//分類選択
function g1change(){
	//テーブル初期化
	while( wtable.rows[ 1 ] ) wtable.deleteRow( 1 );
	getwtint();
}

//更新
function update(){
	intent = document.getElementById('intent').value;
	g1meisho = document.getElementById('g1').value;
	var _token = document.getElementById('_token').value;

	$.ajax({
		type: "POST",
		dataType: "JSON",
		data:{
			"param" : "intentUpdate",
			"g1meisho" : g1meisho,
			"g2meisho" : "",
			"sword" : intent,
			"_token" : _token
		}
	}).done(function (response) {
		//result = JSON.parse(response);
		if(response.status == "OK"){
			alert("更新しました");
			var raw = wtable.insertRow( -1 );
			var td1 = raw.insertCell(-1),td2 = raw.insertCell(-1);
			td2.style.width = "50px";
			td1.innerHTML = intent;
			td2.innerHTML = '<input type="button" value="削除" class="btn btn-default" onclick="delLine(\'' + intent + '\',this)" />';
		}else{
			alert("更新できませんでした");
		}
    }).fail(function () {
        alert("更新できませんでした");
    });
	document.getElementById('intent').value = "";
}

//行削除
function delLine(value,raw){
	/*var myRet = confirm("検索ワード「"+ value + "」を削除しますか？");
	if ( myRet == true ){
		g1meisho = document.getElementById('g1').value;
		$.ajax({
			type: "POST",
			url: "cw2.php",
			data: {
				"param" : "intentDelete",
				"g1meisho" : g1meisho,
				"g2meisho" : "",
				"sword" : value
			}
		}).done(function (response) {
			result = JSON.parse(response);
			if(result == "OK"){
				alert("削除しました");
				tr = raw.parentNode.parentNode;
				tr.parentNode.deleteRow(tr.sectionRowIndex);
			}else{
				alert("削除できませんでした");
			}
	    }).fail(function () {
	        alert("削除できませんでした");
	    });
	}
	*/
}

//もどる
function back(){
	window.location.href = "./genre";
}
