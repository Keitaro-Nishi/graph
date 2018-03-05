var rowIds = [];
var rowcitycode = [];
var rowgid1 = [];
var rowgid2 = [];
var meishoOld = "";
var uiKbn = 0;
var gid2 = 0;

$(function() {
	$("#grid-basic").bootgrid({
		selection : true,
		multiSelect : true,
		rowSelect : true,
		columnSelection : false,
	    keepSelection: true
	}).on("selected.rs.jquery.bootgrid", function(e, rows) {
		for (var i = 0; i < rows.length; i++)
	    {
	        rowIds.push(rows[i].no);
	        rowcitycode.push(rows[i].citycode);
	        rowgid1.push(rows[i].gid1);
	        rowgid2.push(rows[i].gid2);
	        //alert("rowIds:" + rows[i].no + "rowcitycode:" + rows[i].citycode + "rowgid1:" + rows[i].gid1 + " rowgid2:" + rows[i].gid2);
	    }
	}).on("deselected.rs.jquery.bootgrid", function(e, rows) {
		for (var i = 0; i < rows.length; i++)
	    {
	    	for (var ii = 0; ii < rowIds.length; ii++){
		    	if(rowIds[ii] == rows[i].no){
		    		rowIds.splice(ii,1);
		    		rowcitycode.splice(ii,1);
		    		rowgid1.splice(ii,1);
		    		rowgid2.splice(ii,1);
		    		break;
		    	}
	    	}
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

	//大分類が選択されている場合、小分類を削除する
	var idarray = [];
	var g1array = [];
	for (var i = 0; i < rowIds.length; i++){
		idarray.push(rowgid1[i] + "." + rowgid2[i]);
		if(rowgid2[i] == "0"){
			g1array.push(rowgid1[i]);
		}
	}
	g1array.forEach(function(v, i){
		for (var ii = idarray.length - 1; ii >= 0; ii--) {
			var aos = idarray[ii].split(".");
			if(aos[0] == v){
				if(aos[1] > 0){
					idarray.splice(ii,1);
				}
			}
		}
	});

	bootbox.confirm({
	    message: "選択行を削除しますか？\n※大分類を削除すると関連する小分類も削除されます",
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
	    				"ids" : idarray,
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
	    				message: "2削除できませんでした",
	    				size: 'small'
	    			});
	    	    });
	        }
	    }
	});
}
	/*
	var myRet = false;
	if(g1array.length > 0){
		myRet = confirm("選択行を削除しますか？\n※大分類を削除すると関連する小分類も削除されます");
	}else{
		myRet = confirm("選択行を削除しますか？");
	}
	if ( myRet == true ){
		$.ajax({
			type: "POST",
			dataType: "JSON",
			data: {
				"param" : "delete",
				"id" : idarray
			}
		}).done(function (response) {
			result = JSON.parse(response);
			if(result == "OK"){
				alert("削除しました");
				location.reload();
			}else{
				alert("削除できませんでした");
			}
		}).fail(function () {
			alert("削除できませんでした");
		});
	}*/


