var rowIds = [];
$(function() {
	$("#grid-basic").bootgrid({
		selection : true,
		multiSelect : true,
		//rowSelect : true,
		keepSelection : true
	}).on("selected.rs.jquery.bootgrid", function(e, rows) {
		for (var i = 0; i < rows.length; i++) {
			rowIds.push(rows[i].id);
		}
	}).on("deselected.rs.jquery.bootgrid", function(e, rows) {
		for (var i = 0; i < rows.length; i++) {
			rowIds.some(function(v, ii) {
				if (v == rows[i].id)
					rowIds.splice(ii, 1);
			});
		}
	});
/*
	//ジャンルの設定
	var genre1value = <?php echo json_encode($genre1value); ?>;
	var select = document.getElementById('dia_genre1');
	for( var key in genre1value ) {
		var option = document.createElement('option');
		option.setAttribute('value', key);
		var text = document.createTextNode(genre1value[key]);
		option.appendChild(text);
		select.appendChild(option);
	}
	genre1change();
*/
});

function drow() {
	if(rowIds.length == 0){
		alert("削除する行を選択してください");
		return;
	}
	var successFlg = true;
	var myRet = confirm("選択行を削除しますか？");
	if ( myRet == true ){
		for (var i = 0; i < rowIds.length; i++){
			$.ajax({
				type: "DELETE",
				url: 'facility/'+ rowIds[i],
			}).then(
					function(){
					},
					function(){
						successFlg = false;
					}
			);
		}
		if( successFlg == true){
			alert("削除しました");
			location.reload();
		}else{
			alert("削除できませんでした");
		}
	}
}

function insert() {
	document.getElementById("modal-label").innerHTML  = "施設登録";
	initmodal();
	document.getElementById("btn_modal").click();
}
/*
//ジャンル選択
function genre1change(){
	var select = document.getElementById('dia_genre2');
	while (0 < select.childNodes.length) {
		select.removeChild(select.childNodes[0]);
	}
	var genre2value = <?php echo json_encode($genre2value); ?>;
	var janru = genre2value[document.getElementById('dia_genre1').value];
	for( var key in janru ) {
		var option = document.createElement('option');
		option.setAttribute('value', key);
		var text = document.createTextNode(janru[key]);
		option.appendChild(text);
		select.appendChild(option);
	}
}
*/
//地図の確認
function map(){
	latlng = document.getElementById('dia_latlng').value;
	window.open( "http://maps.google.com/maps?q=" + latlng + "+(ココ)", '_blank');
}
//画像の確認
function image(){
	imageurl = document.getElementById('dia_iurl').value;
	window.open( imageurl, '_blank');
}

//ダイアログ初期化
function initmodal(){
	document.getElementById('dia_meisho').value = "";
/*	document.getElementById('dia_jusho').value = "";
	document.getElementById('dia_tel').value = "";
	document.getElementById('dia_genre1').selectedIndex = 0;
	genre1change();
	document.getElementById('dia_latlng').value = "";
	document.getElementById('dia_imageurl').value = "";
	document.getElementById('dia_url').value = "";*/
}
