var rowIds = [];
var rowgid1 = [];
var rowgid2 = [];
var meishoOld = "";
var uiKbn = 0;
var gid2 = 0;

$(function() {
	$("#grid-basic").bootgrid({
		selection: true,
		multiSelect: true,
		columnSelection : false,
	    keepSelection: true/*,
	    formatters: {
	        "mods": function($column, $row) {
	        	return "<input type='button' class='btn btn-default' value='修正' onclick='modwin(\"" + $row.gid1 + "\",\"" + $row.gid2 + "\",\"" + $row.g1 + "\",\"" + $row.g2 + "\")' > ";
             }
	    }*/
	}).on("selected.rs.jquery.bootgrid", function(e, rows)
	{
		for (var i = 0; i < rows.length; i++)
	    {
	        rowIds.push(rows[i].citycode);
	        rowgid1.push(rows[i].gid1);
	        rowgid2.push(rows[i].gid2);
	        //alert("rowgid1:" + rows[i].gid1 + " rowgid2:" + rows[i].gid2);
	    }
	    //alert("Select: " + rowIds.join(","));
	}).on("deselected.rs.jquery.bootgrid", function(e, rows)
	{
	    for (var i = 0; i < rows.length; i++)
	    {
	    	for (var ii = 0; ii < rowIds.length; ii++){
		    	if(rowIds[ii] == rows[i].citycode){
		    		rowIds.splice(ii,1);
		    		rowgid1.splice(ii,1);
		    		rowgid2.splice(ii,1);
		    		break;
		    	}
	    	}
	        //rowIds.push(rows[i].no);
	    }
	    //alert("Deselect: " + rowIds.join(","));
	});
});
	/*
	//ジャンルの設定
	var j1value = <?php echo json_encode($j1value); ?>;
	var select = document.getElementById('dia_g1');
	for( var key in j1value ) {
		var option = document.createElement('option');
		option.setAttribute('value', key);
		var text = document.createTextNode(j1value[key]);
		option.appendChild(text);
		select.appendChild(option);
	}*/


/*
function drow() {
	if(rowIds.length == 0){
		alert("削除する行を選択してください");
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
	var myRet = false;
	if(g1array.length > 0){
		myRet = confirm("選択行を削除しますか？\n※大分類を削除すると関連する小分類も削除されます");
	}else{
		myRet = confirm("選択行を削除しますか？");
	}
	if ( myRet == true ){
		$.ajax({
			type: "POST",
			url: "genredel.php",
			data: {
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
	}
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

//分類選択
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

//ダイアログ初期化
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
	$.ajax({
		type: "POST",
		url: "genreup.php",
		data: {
			"uiKbn" : uiKbn,
			"bunrui" : bunrui,
			"meisho" : meisho,
			"gid1" : gid1,
			"gid2" : gid2,
			"g1meisho" : g1meisho,
			"meishoOld" : meishoOld
		}
	}).done(function (response) {
		result = JSON.parse(response);
		if(result == "OK"){
			alert("更新しました");
			location.reload();
		}else{
			alert("更新できませんでした");
		}
    }).fail(function () {
        alert("更新できませんでした");
    });
}

function intent(){
	window.location.href = "./genreint.blade.php";
}
function entity(){
	window.location.href = "./genreent.php";
}
*/
