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
		rowSelect : false,
		columnSelection : false,
	    keepSelection: true,
	    formatters: {
	        "mods": function($column, $row) {
	        	return "<input type='button' class='btn btn-default' value='修正' onclick='modwin("  + $row.no + ",\"" + $row.gid1 + "\",\"" + $row.gid2 + "\",\"" + $row.g1 + "\",\"" + $row.g2 + "\")' > ";
             }
	    }
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

function irow(){
	document.getElementById('modal-label').innerHTML  = "ジャンル追加";
	uiKbn = 2;
	meishoOld = "";
	gid2 = 0;
	initmodal();
	document.getElementById('dia_g1').style.display = "none";
	document.getElementById('dia_g2meisho').disabled = true;
	document.getElementById("btn_modal").click();
}

function bchange(){
	if(document.getElementById('dia_bunrui').value == 1){
		document.getElementById('dia_g1').style.display = "none";
		document.getElementById('dia_g1meisho').style.display = "block";
		document.getElementById('dia_g2meisho').disabled = true;
		document.getElementById('dia_g2meisho').value = "";
	}
	if(document.getElementById('dia_bunrui').value == 2){
		document.getElementById('dia_g1').style.display = "block";
		document.getElementById('dia_g1meisho').style.display = "none"
		document.getElementById('dia_g2meisho').disabled = false;
	}
}


function modwin(no,gid1,_gid2,g1,g2){
	document.getElementById('modal-label').innerHTML  = "ジャンル修正";
	initmodal();
	gid2 = _gid2;
	uiKbn = 1;
	document.getElementById('dia_bunrui').disabled = true;
	if(gid2 > 0){
		meishoOld = g2;
		document.getElementById('dia_bunrui').value = 2;
		document.getElementById('dia_g1').value = gid1;
		document.getElementById('dia_g1').disabled = true;
		document.getElementById('dia_g1meisho').style.display = "none";
		document.getElementById('dia_g2meisho').value = g2;
	}else{
		meishoOld = g1;
		document.getElementById('dia_bunrui').value = 1;
		document.getElementById('dia_g1').value = gid1;
		document.getElementById('dia_g1').style.display = "none";
		document.getElementById('dia_g1meisho').value = g1;
		document.getElementById('dia_g2meisho').disabled = true;
	}
	document.getElementById("btn_modal").click();
}


function initmodal(){
	document.getElementById('dia_bunrui').value = 1;
	document.getElementById('dia_g1').selectedIndex = 0;
	document.getElementById('dia_g1meisho').value = "";
	document.getElementById('dia_g2meisho').value = "";
	document.getElementById('dia_g1meisho').style.display = "block";
	document.getElementById('dia_g1').style.display = "block";
	document.getElementById('dia_bunrui').disabled = false;
	document.getElementById('dia_g1').disabled = false;
	document.getElementById('dia_g1meisho').disabled = false;
	document.getElementById('dia_g2meisho').disabled = false;
}

//更新
function update(){

	var bunrui = document.getElementById('dia_bunrui').value;
	var gid1 = document.getElementById('dia_g1').value;
	var g1meisho = document.getElementById('dia_g1').options[document.getElementById('dia_g1').selectedIndex].text;
	var meisho = "";
	if(bunrui == 1){
		meisho = document.getElementById('dia_g1meisho').value;
	}else{
		meisho = document.getElementById('dia_g2meisho').value;
	}
	var _token = document.getElementById('_token').value;

	$.ajax({
		type: "POST",
		dataType: "JSON",
		data:{
			"param" : "update",
			"uiKbn" : uiKbn,
			"bunrui" : bunrui,
			"meisho" : meisho,
			"gid1" : gid1,
			"gid2" : gid2,
			"g1meisho" : g1meisho,
			"meishoOld" : meishoOld,
			"_token" : _token
		}
	}).done(function (response) {
		if(response.status == "OK"){
			bootbox.alert({
				message: "更新しました",
				size: 'small',
				callback: function () {
					location.reload();
				}
			});
		}else{
			var mes = "";
			for (var item in response) {
				if(mes != ""){
					mes = mes + "<br>";
				}
			    mes = mes + response[item][0];
			}
			bootbox.alert({
				message: mes,
				size: 'small'
			});
		}
    }).fail(function () {
    	bootbox.alert({
			message: "更新できませんでした",
			size: 'small'
		});
    });

	function intent(){
		window.location.href = "./genreint.php";
	}
	function entity(){
		window.location.href = "./genreent.php";
	}

}

