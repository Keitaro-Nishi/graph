var rowIds = [];

function init() {
	$("#grid-basic").bootgrid({
		selection : true,
		multiSelect : true,
		columnSelection : false,
		keepSelection : true,
		formatters: {
			"image": function($column, $row) {
				return "<img class='table-img' src='" + location.href + "/" + $row.no + "' />";
			},
			"zoom": function($column, $row) {
				return "<input type='button' class='btn btn-default' value='画像拡大' onclick='imgwin("  + $row.no + ",\"" + $row.cls + "\"," + $row.scr + ")'> ";
			}
		}
	}).on("selected.rs.jquery.bootgrid", function(e, rows) {
		for (var i = 0; i < rows.length; i++) {
			rowIds.push(rows[i].no);
		}
	}).on("deselected.rs.jquery.bootgrid", function(e, rows) {
		for (var i = 0; i < rows.length; i++) {
			rowIds.some(function(v, ii) {
				if (v == rows[i].no)
					rowIds.splice(ii, 1);
			});
		}
	});
}

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
						"nos" : rowIds,
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

function imgwin(imgno,bunrui,kakushin){
	var oimg = new Image();
	oimg.src = location.href + "/" + imgno;
	var img = document.getElementById("dia_image");
	img.src = oimg.src;
	img.width = oimg.width;
	img.height = oimg.height;
	document.getElementById('dia_kaku').innerHTML  = "分類：" + bunrui + "　　確信度：" + kakushin;
	if(img.width > 600){
		var orgWidth  = img.width;
		var orgHeight = img.height;
		img.width = 600;
		img.height = orgHeight * (img.width / orgWidth);
	}
	var imgwidth = img.width + 40;
	if(imgwidth < 600){
		imgwidth = 600;
	}
	document.getElementById('dia_cont').style.width = imgwidth + "px";
	document.getElementById("btn_modal").click();
}