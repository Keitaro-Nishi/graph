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

	//大分類のgid1と一致する小分類の値を表示する
	$('select[name="daibunrui"]').change(function() {
		var daibunruiName = $('select[name="daibunrui"] option:selected').attr("class");
		var count = $('select[name="shoubunrui"]').children().length;

		for (var i=0; i<count; i++) {
			var shoubunrui = $('select[name="shoubunrui"] option:eq(' + i + ')');

			if(shoubunrui.attr("class") === daibunruiName)
			{
				shoubunrui.show();
			}else {
				if(shoubunrui.attr("class") === "message") {
						shoubunrui.show();
						shoubunrui.prop('selected',true);
				} else {
					shoubunrui.hide();
				}
			}
		}
	})

});


//インテント取得
function getwtent(){

	g1meisho = document.getElementById('g1').value;
	g2meisho = document.getElementById('g2').options[document.getElementById('g2').selectedIndex].text;
	var _token = document.getElementById('_token').value;

	$.ajax({
		type: "POST",
		dataType: "JSON",
		data: {
			"param" : "entitySearch",
			"g1meisho" : g1meisho,
			"g2meisho" : g2meisho,
			"sword" : "",
			"_token" : _token
		}
	}).done(function (response) {
		//result = JSON.parse(response);
		for( var i =0; i<response.length; i++ ) {
			var raw = wtable.insertRow( -1 );
			var td1 = raw.insertCell(-1),td2 = raw.insertCell(-1);
			td2.style.width = "50px";
			td1.innerHTML = response[i];
			td2.innerHTML = '<input type="button" value="削除" class="btn btn-default" onclick="delLine(\'' + response[i] + '\',this)" />';
		}
    }).fail(function () {
    	if(g2meisho !="小分類を選択してください。")
    	{
    		alert("Watsonデータの取得に失敗しました");
    	}
    });

}


//小分類切替
function g2change(){

	//テーブル初期化
	while( wtable.rows[ 1 ] ) wtable.deleteRow( 1 );
	getwtent();


}


//更新
function update(){
	synonym = document.getElementById('synonym').value;
	g1meisho = document.getElementById('g1').value;
	g2meisho = document.getElementById('g2').options[document.getElementById('g2').selectedIndex].text;
	var _token = document.getElementById('_token').value;

	$.ajax({
		type: "POST",
		dataType: "JSON",
		data: {
			"param" : "entityUpdate",
			"g1meisho" : g1meisho,
			"g2meisho" : g2meisho,
			"sword" : synonym,
			"_token" : _token
		}
	}).done(function (response) {
		//result = JSON.parse(response);
		if(response.status == "OK"){
			alert("更新しました");
			var raw = wtable.insertRow( -1 );
			var td1 = raw.insertCell(-1),td2 = raw.insertCell(-1);
			td2.style.width = "50px";
			td1.innerHTML = synonym;
			td2.innerHTML = '<input type="button" value="削除" class="btn btn-default" onclick="delLine(\'' + synonym + '\',this)" />';
		}else{
			alert("更新できませんでした");
		}
    }).fail(function () {
        alert("更新できませんでした");
    });
	document.getElementById('synonym').value = "";
}


//行削除
function delLine(value,raw){

	var myRet = confirm("検索ワード「"+ value + "」を削除しますか？");
	var _token = document.getElementById('_token').value;

	if ( myRet == true ){
		g1meisho = document.getElementById('g1').value;
		g2meisho = document.getElementById('g2').options[document.getElementById('g2').selectedIndex].text;
		$.ajax({
			type: "POST",
			dataType: "JSON",
			data: {
				"param" : "entityDelete",
				"g1meisho" : g1meisho,
				"g2meisho" : g2meisho,
				"sword" : value,
				"_token" : _token
			}
		}).done(function (response) {
			//result = JSON.parse(response);
			if(response.status == "OK"){
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

}


//もどる
function back(){
	window.location.href = "./genre";
}
