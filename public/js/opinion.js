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

				alert(dbvalue[0]["opinion"]);

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
							url: 'opinion/'+ rowIds[i],
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
     			document.getElementById('dia_userid').value  = dbvalue[index]["userid"];
				document.getElementById('dia_time').value = dbvalue[index]["time"];
				document.getElementById('dia_sadness').value  = dbvalue[index]["sadness"];
				document.getElementById('dia_joy').value  = dbvalue[index]["joy"];
				document.getElementById('dia_fear').value  = dbvalue[index]["fear"];
				document.getElementById('dia_disgust').value  = dbvalue[index]["disgust"];
				document.getElementById('dia_anger').value  = dbvalue[index]["anger"];
				document.getElementById('dia_checked').value  = dbvalue[index]["checked"];
				document.getElementById('dia_opinion').innerHTML  = dbvalue[index]["opinion"];
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
