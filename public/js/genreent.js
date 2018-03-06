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

	g1change();
});
/*
//インテント取得
function getwtent(){
	g1meisho = document.getElementById('g1').value;
	g2meisho = document.getElementById('g2').options[document.getElementById('g2').selectedIndex].text;
	$.ajax({
		type: "POST",
		url: "cw2.php",
		data: {
			"param" : "entitySearch",
			"g1meisho" : g1meisho,
			"g2meisho" : g2meisho,
			"sword" : ""
		}
	}).done(function (response) {
		result = JSON.parse(response);
		for( var index in result ) {
			var raw = wtable.insertRow( -1 );
			var td1 = raw.insertCell(-1),td2 = raw.insertCell(-1);
			td2.style.width = "50px";
			td1.innerHTML = result[index];
			td2.innerHTML = '<input type="button" value="削除" class="btn btn-default" onclick="delLine(\'' + result[index] + '\',this)" />';
		}
    }).fail(function () {
        alert("Watsonデータの取得に失敗しました");
    });
}
*/
//大分類切替
function g1change(){
	var g2value = [];
	g2value = document.getElementById('shoubunrui');
	alert(g2value[0][0]);

	/*
	var select2 = document.getElementById('g2');
	while(select2.lastChild)
	{
		select2.removeChild(select2.lastChild);
	}
	g1value = document.getElementById('g1').value;
	for( var key in g2value ) {
		g12 = key.split(".");
		if(g12[0] == g1value){
			var option = document.createElement('option');
			option.setAttribute('value', g12[1]);
			var text = document.createTextNode(g2value[key]);
			option.appendChild(text);
			select2.appendChild(option);
		}
	}

	g2change();
	*/
}

//小分類切替
function g2change(){

	//テーブル初期化
	while( wtable.rows[ 1 ] ) wtable.deleteRow( 1 );
	//getwtent();
}

/*
//更新
function update(){
	synonym = document.getElementById('synonym').value;
	g1meisho = document.getElementById('g1').value;
	g2meisho = document.getElementById('g2').options[document.getElementById('g2').selectedIndex].text;
	$.ajax({
		type: "POST",
		url: "cw2.php",
		data: {
			"param" : "entityUpdate",
			"g1meisho" : g1meisho,
			"g2meisho" : g2meisho,
			"sword" : synonym
		}
	}).done(function (response) {
		result = JSON.parse(response);
		if(result == "OK"){
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
	var myRet = confirm("類義語「"+ value + "」を削除しますか？");
	if ( myRet == true ){
		g1meisho = document.getElementById('g1').value;
		g2meisho = document.getElementById('g2').options[document.getElementById('g2').selectedIndex].text;
		$.ajax({
			type: "POST",
			url: "cw2.php",
			data: {
				"param" : "entityDelete",
				"g1meisho" : g1meisho,
				"g2meisho" : g2meisho,
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
}

*/

//もどる
function back(){
	window.location.href = "./genre";
}
