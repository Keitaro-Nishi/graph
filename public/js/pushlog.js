var rowIds = [];
var pushlog = [];
var dbvalue = [];
var meisho = [];
var meishovalue = [];


pushlog = document.getElementById('pushlog').value;
dbvalue = JSON.parse(pushlog);


$(function() {

	$("#grid-basic").bootgrid({
		selection : true,
		multiSelect : true,
		keepSelection : true,
		columnSelection : false,
		formatters: {
			"details": function($column, $row) {
				return "<input type='button' class='btn btn-default' value='対象情報' onclick='detailwin("  + $row.no +   ")'> ";
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

	taishoDisabled(true);

});

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
				console.log(_token);
				$.ajax({
					type: "POST",
					dataType: "JSON",
					data:{
						"param" : "delete",
						"no" : rowIds,
						"_token" : _token
					}

				}).done(function (response) {
					if(response.status == "OK"){
						bootbox.alert({
							message: "削除しました",
							size: 'small',
							callback: function () {
								location.reload();
							}
						});
					}
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

function detailwin(value){

	document.getElementById("btn_modal").click();
	for (var i = 0; i < dbvalue.length; i++){
		if(dbvalue[i]["no"] == value){
			modal_mod(i);
		}
	}
}


//オプションチェンジ
function optionChange(){
	taishocount();
}

function taishoDisabled(bl){
	for(var i = 1; i < 11; i++){
		if(document.getElementById('option'+i)){
			document.getElementById('option'+i).disabled = bl;
		}
	}
}

function modal_mod(index){
		document.getElementById('dia_number').value  = dbvalue[index]["target"];
		document.getElementById('dia_register').value = dbvalue[index]["info"];
		document.getElementById('dia_age').value  = dbvalue[index]["age"];
		document.getElementById('dia_sex').value  = dbvalue[index]["sex"];
}

