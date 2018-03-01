var rowIds = [];
$(function() {
	$("#grid-basic").bootgrid({
		selection : true,
		multiSelect : true,
		//rowSelect : true,
		keepSelection : true
	    formatters: {
	        "image": function($column, $row) {
	              return "<img class='table-img' src='' />";
	         },
	        "zoom": function($column, $row) {
                  //return "<button type=\"button\" class=\"btn btn-xs btn-default command-edit\" data-row-id=\"" + $row.no + "\">画像拡大</button> ";
	        	//return "<Form><input type='button' value='画像拡大' onClick='window.open('" + getimage.php?id=$row.no + "','test','width=250,height=100,');'></Form> ";
	        	//return "<Form><input type='button' value='画像拡大' onclick='imgwin()'></Form> ";
	        	return "<input type='button' class='btn btn-default' value='画像拡大' onclick=''> ";
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
		alert("削除する行を選択してください");
		return;
	}
	var successFlg = true;
	var myRet = confirm("選択行を削除しますか？");
	if ( myRet == true ){
		for (var i = 0; i < rowIds.length; i++){
			$.ajax({
				type: "DELETE",
				url: 'logimage/'+ rowIds[i],
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

function imgwin(imgno,bunrui,kakushin){
	var oimg = new Image();
	oimg.src = "getimage.php?id=" + imgno;
	var img = document.getElementById("dia_image");
	img.width = oimg.width;
	img.height = oimg.height;
	document.getElementById('dia_kaku').innerHTML  = "分類：" + bunrui + "　　確信度：" + kakushin;
	img.src = "getimage.php?id=" + imgno;
	var img = document.getElementById("dia_image");
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
	var imgmar = img.width / 2;
	document.getElementById('dia_cont').style.width = imgwidth + "px";
	document.getElementById("btn_modal").click();
}