var rowIds = [];

$(function() {
	$("#grid-basic").bootgrid({
		selection : true,
		multiSelect : true,
		rowSelect : false,
		columnSelection : false,
	    keepSelection: true,
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
	    				"logindataids" : rowIds,
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

