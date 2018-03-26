var rowIds = [];
var shosai_idx = 0;
var opinion = [];
var dbvalue = [];

opinion= document.getElementById('opinion').value;
dbvalue = JSON.parse(opinion);

$(function() {
	$("#grid-basic").bootgrid({
		selection : true,
		multiSelect : true,
		rowSelect : false,
		columnSelection : false,
		keepSelection : true,
		formatters: {
			"details": function($column, $row) {
				return "<input type='button' class='btn btn-default' value='詳細' onclick='detailwin("  + $row.id + ")'> ";
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
				$.ajax({
					type: "POST",
					dataType: "JSON",
					data:{
						"param" : "delete",
						"opinionids" : rowIds,
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
		if(dbvalue[i]["id"] == value){
			shosai_idx = i;
			modal_mod(i);
		}
	}
}

function shosai_back(){
	shosai_idx = shosai_idx - 1;
	modal_mod(shosai_idx);
}
function shosai_next(){
	shosai_idx = shosai_idx + 1;
	modal_mod(shosai_idx);
}

function modal_mod(index){
	var ctx = document.getElementById('myChart').getContext('2d');
	document.getElementById("disp").style.display="none";

	document.getElementById('dia_userid').value  = dbvalue[index]["userid"];
	document.getElementById('dia_time').value = dbvalue[index]["time"];
	document.getElementById('dia_sadness').value  = dbvalue[index]["sadness"];
	document.getElementById('dia_joy').value  = dbvalue[index]["joy"];
	document.getElementById('dia_fear').value  = dbvalue[index]["fear"];
	document.getElementById('dia_disgust').value  = dbvalue[index]["disgust"];
	document.getElementById('dia_anger').value  = dbvalue[index]["anger"];
	document.getElementById('dia_checked').value  = dbvalue[index]["checked"];
	document.getElementById('dia_opinion').innerHTML  = dbvalue[index]["opinion"];

	var myChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: ['悲しみ', '喜び', '恐れ', '嫌悪', '怒り'],
			datasets: [{
				label: '感情',
				data: [dbvalue[index]["sadness"],dbvalue[index]["joy"],dbvalue[index]["fear"],dbvalue[index]["disgust"],dbvalue[index]["anger"]],
				backgroundColor: "rgba(153,255,51,0.4)"
			}]
		}
	});

	if(index == 0){
		document.getElementById("sback").disabled = "true";
	}else{
		document.getElementById("sback").disabled = "";
	}
	if(index == dbvalue.length - 1){
		document.getElementById("snext").disabled = "true";
	}else{
		document.getElementById("snext").disabled = "";
	}
}