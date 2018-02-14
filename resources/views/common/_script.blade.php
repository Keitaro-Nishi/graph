<!--
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.bootgrid.js"></script>
<script type="text/javascript">
$(function(){
	var rowIds = [];

	$(function() {
		$("#grid-basic").bootgrid({
			selection : true,
			multiSelect : true,
			rowSelect : true,
			keepSelection : true
		}).on("selected.rs.jquery.bootgrid", function(e, rows) {
			for (var i = 0; i < rows.length; i++) {
				rowIds.push(rows[i].userid);
			}
		}).on("deselected.rs.jquery.bootgrid", function(e, rows) {
			for (var i = 0; i < rows.length; i++) {
				rowIds.some(function(v, ii) {
					if (v == rows[i].userid)
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
					type: "GET",
					url: 'ajax/'+ rowIds[i],
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
});
</script>
 -->