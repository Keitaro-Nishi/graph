var rowIds = [];
//var botlog = [];
//var dbvalue = [];
//var shosai_idx = 0;

//botlog = document.getElementById('botlog').value;
//dbvalue = JSON.parse(botlog);

$(function() {

	$("#grid-basic").bootgrid({
		selection : true,
		multiSelect : true,
		keepSelection : true,
		columnSelection : false,
		formatters: {
			"details": function($column, $row) {
				return "<input type='button' class='btn btn-default' value='詳細' onclick='detailwin("  + $row.no + ")'> ";
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
