var rowIds = [];

function init() {
	$("#grid-basic").bootgrid({
		selection : true,
		multiSelect : true,
		keepSelection : true,
		columnSelection : false,
		formatters: {
			"mods": function($column, $row) {
				return "<input type='button' class='btn btn-default' value='修正' onclick='modwin("  + $row.id + ",\"" + $row.meisho + "\",\"" + $row.jusho + "\",\"" + $row.tel + "\",\"" + $row.genre1 + "\",\"" + $row.genre2 + "\",\"" + $row.lat + "\",\"" + $row.lng + "\",\"" + $row.imageurl + "\",\"" + $row.url + "\")' > ";
			}
		}
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
}
//施設情報削除
function drow() {
	if(rowIds.length == 0){
		bootbox.alert({
			message: "削除する行を選択してください",
			size: 'small'
		});
		return;
	}

	bootbox.confirm({
		message: "選択行を削除しますか？",
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
					data:{
						"param" : "delete",
						"ids" : rowIds,
						"_token" : _token
					}
				}).done(function (response) {
					bootbox.alert({
						message: "削除しました",
						size: 'small',
						callback: function () {
							location.reload();
						}
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

//施設情報修正
function modwin(id,meisho,jusho,tel,genre1,genre2,lat,lng,imageurl,url){
	document.getElementById('modal-label').innerHTML  = "施設情報修正";
	modID = id;
	initmodal();
	document.getElementById('dia_id').value = id;
	document.getElementById('dia_meisho').value = meisho;
	document.getElementById('dia_jusho').value = jusho;
	document.getElementById('dia_tel').value = tel;
	document.getElementById('dia_genre1').value = genre1;
	genre1change();
	document.getElementById('dia_genre2').value = genre2;
	document.getElementById('dia_latlng').value = lat + "," + lng;
	document.getElementById('dia_imageurl').value = imageurl;
	document.getElementById('dia_url').value = url;
	document.getElementById("btn_modal").click();
}

function insert() {
	document.getElementById('dia_id').value = "";
	document.getElementById('dia_genre1').value = 0;
	document.getElementById("modal-label").innerHTML  = "施設登録";
	initmodal();
	document.getElementById("btn_modal").click();
}

//ジャンル選択
function genre1change(){
	var select = document.getElementById('dia_genre2');
	while (0 < select.childNodes.length) {
		select.removeChild(select.childNodes[0]);
	}
	g2value = genre2value[document.getElementById('dia_genre1').value];
	for(var i = 0; i < g2value.length; i++) {
		var option = document.createElement('option');
		option.setAttribute('value', g2value[i]['gid2']);
		var text = document.createTextNode(g2value[i]['meisho']);
		option.appendChild(text);
		select.appendChild(option);
	}
}

//ダイアログ初期化
function initmodal(){
	document.getElementById('dia_meisho').value = "";
	document.getElementById('dia_jusho').value = "";
	document.getElementById('dia_tel').value = "";
	document.getElementById('dia_genre1').selectedIndex = 0;
	genre1change();
	document.getElementById('dia_latlng').value = "";
	document.getElementById('dia_imageurl').value = "";
	document.getElementById('dia_url').value = "";
}

function update(){

	var id = document.getElementById('dia_id').value;
	var meisho = document.getElementById('dia_meisho').value;
	var jusho = document.getElementById('dia_jusho').value;
	var tel = document.getElementById('dia_tel').value;
	var genre1 = document.getElementById('dia_genre1').value;
	var genre2 = document.getElementById('dia_genre2').value;
	var latlng = document.getElementById('dia_latlng').value;
	var arrayOfStrings = latlng.split(",");
	var lat = arrayOfStrings[0];
	var lng = arrayOfStrings[1];
	var imageurl = document.getElementById('dia_imageurl').value;
	var url = document.getElementById('dia_url').value;
	var _token = document.getElementById('_token').value;

	$.ajax({
		type: "POST",
		dataType: "JSON",
		data: {
			"param" : "update",
			"id" : id,
			"meisho" : meisho,
			"jusho" : jusho,
			"tel" : tel,
			"genre1" : genre1,
			"genre2" : genre2,
			"lat" : lat,
			"lng" : lng,
			"imageurl" : imageurl,
			"url" : url,
			"_token" : _token
		}
	}).done(function (response) {
		bootbox.alert({
			message: "更新しました",
			size: 'small',
			callback: function () {
				location.reload();
			}
		});
	}).fail(function () {
		bootbox.alert({
			message: "更新できませんでした",
			size: 'small'
		});
	});
}
//地図の確認
function map(){
	latlng = document.getElementById('dia_latlng').value;
	window.open( "http://maps.google.com/maps?q=" + latlng + "+(ココ)", '_blank');
}
//画像の確認
function image(){
	imageurl = document.getElementById('dia_imageurl').value;
	window.open( imageurl, '_blank');
}