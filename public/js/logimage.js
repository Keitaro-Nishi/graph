var rowIds = [];
$(function() {
	$("#grid-basic").bootgrid({
		selection : true,
		multiSelect : true,
		rowSelect : true,
		keepSelection : true
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
/*
	var h = $(window).height();
	$('#wrap').css('display','none');
	$('#loader-bg ,#loader').height(h).css('display','block');

	$("#grid-basic").bootgrid({
		selection: true,
		multiSelect: true,
	    keepSelection: true,
	    formatters: {
	        "image": function($column, $row) {
	              return "<img class='table-img' src='getimage.php?id=" + $row.no + "' />";
	         },
	        "zoom": function($column, $row) {
                  //return "<button type=\"button\" class=\"btn btn-xs btn-default command-edit\" data-row-id=\"" + $row.no + "\">画像拡大</button> ";
	        	//return "<Form><input type='button' value='画像拡大' onClick='window.open('" + getimage.php?id=$row.no + "','test','width=250,height=100,');'></Form> ";
	        	//return "<Form><input type='button' value='画像拡大' onclick='imgwin()'></Form> ";
	        	return "<input type='button' class='btn btn-default' value='画像拡大' onclick='imgwin("  + $row.no + ",\"" + $row.cls + "\"," + $row.scr + ")'> ";
             }
	    }
	}).on("selected.rs.jquery.bootgrid", function(e, rows)
	{
	    for (var i = 0; i < rows.length; i++)
	    {
	        rowIds.push(rows[i].no);
	    }
	    //alert("Select: " + rowIds.join(","));
	}).on("deselected.rs.jquery.bootgrid", function(e, rows)
	{
	    for (var i = 0; i < rows.length; i++)
	    {
	    	rowIds.some(function(v, ii){
	    	    if (v==rows[i].no) rowIds.splice(ii,1);
	    	});
	        //rowIds.push(rows[i].no);
	    }
	    //alert("Deselect: " + rowIds.join(","));
	});
});

$(window).load(function () { //全ての読み込みが完了したら実行
	  $('#loader-bg').delay(900).fadeOut(800);
	  $('#loader').delay(600).fadeOut(300);
	  $('#wrap').css('display', 'block');
});
*/

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
				url: 'facility/'+ rowIds[i],
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

