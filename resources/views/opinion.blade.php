<!DOCTYPE html>
<html>
<head>
<meta name="description" content="市政へのご意見">
<title>市政へのご意見</title>
<link href="css/common.css" rel="stylesheet" />
<link href="css/bootstrap.css" rel="stylesheet" />
<link href="css/jquery.bootgrid.css" rel="stylesheet" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.bootgrid.js"></script>
</head>
<body>
<div id="wrap" style="display:none">
<div id="header"></div>
<table id="grid-basic"
	class="table table-condensed table-hover table-striped">
	<thead>
		<tr>
			   <th data-column-id='no' data-type='numeric' data-identifier='true' data-width='3%'>No</th>
			   <th data-column-id='date' data-width='7%'>日時</th>
               <th data-column-id='sex'  data-width='5%'>性別</th>
               <th data-column-id='age'  data-width='5%'>年齢</th>
               <th data-column-id='sadness' data-type='numeric' data-width='9%'>悲しみ</th>
               <th data-column-id='joy' data-type='numeric' data-width='9%'>喜び</th>
               <th data-column-id='fear' data-type='numeric' data-width='9%'>恐れ</th>
               <th data-column-id='disgust' data-type='numeric' data-width='9%'>嫌悪</th>
               <th data-column-id='anger' data-type='numeric' data-width='9%'>怒り</th>
               <th data-column-id='opinion'  data-width='30%'>ご意見</th>
               <th data-column-id='detail'  data-width='5%' data-formatter='details' data-sortable='false'></th>
		</tr>
	</thead>
	<tbody>
		@foreach($opinions as $opinion)
		<tr>
			<td>{{$opinion->no}}</td>
			<td>{{$opinion->date}}</td>
			@if ($opinion->sex == '1' )
			<td>男</td>
			@elseif ($opinion->sex == '2' )
			<td>女</td>
			@else
			<td>登録なし</td>
			@endif
			<td>{{$opinion->age}}</td>
			<td>{{$opinion->sadness}}</td>
			<td>{{$opinion->joy}}</td>
			<td>{{$opinion->fear}}</td>
			<td>{{$opinion->disgust}}</td>
			<td>{{$opinion->anger}}</td>
			<td>{{$opinion->opinion}}</td>
			<td></td>

		</tr>
		@endforeach
	</tbody>
</table>

<div class="container" align="center">
	<input id="btn_del" type="button" class="btn btn-default" value="選択行の削除" onclick="drow()">
	<input id="btn_modal" type="button" style="display:none" data-toggle="modal"  data-target="#shosaiDialog" value="モーダル表示" />
</div>
</div>

<div class="modal" id="shosaiDialog"  tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content" style="width:740px; margin-left: -20px;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="modal-label">詳細</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_date">No</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="dia_no" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_date">日時</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="dia_date" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_sex">性別</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="dia_sex" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_age">年齢</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="dia_age" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_sadness">悲しみ</label>
						<div class="col-sm-2">
							<input type="text" class="form-control" id="dia_sadness" readonly>
						</div>
						<label class="col-sm-2 control-label" for="dia_joy">喜び</label>
						<div class="col-sm-2">
							<input type="text" class="form-control" id="dia_joy" readonly>
						</div>
						<label class="col-sm-2 control-label" for="dia_fear">恐れ</label>
						<div class="col-sm-2">
							<input type="text" class="form-control" id="dia_fear" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_disgust">嫌悪</label>
						<div class="col-sm-2">
							<input type="text" class="form-control" id="dia_disgust" readonly>
						</div>
						<label class="col-sm-2 control-label" for="dia_anger">怒り</label>
						<div class="col-sm-2">
							<input type="text" class="form-control" id="dia_anger" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_opinion">ご意見</label>
						<div class="col-sm-10">
							<textarea class="form-control" id="dia_opinion" rows='5' readonly></textarea>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button id="sback" type="button" class="btn btn-default" onclick="shosai_back()">＜＜前へ</button>
				<button id="snext" type="button" class="btn btn-default" onclick="shosai_next()">次へ＞＞</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
			</div>
		</div>
	</div>
</div>

<script>
			var rowIds = [];
			var dbvalue = [];
			var shosai_idx = 0;

			$(function() {
				$("#header").load("header.html");
				$("#grid-basic").bootgrid({
					selection : true,
					multiSelect : true,
					rowSelect : true,
					keepSelection : true,
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
					if(dbvalue[i][0] == value){
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
				document.getElementById('dia_no').value  = dbvalue[index][0];
				var idate = dbvalue[index][1].substr(0,4) + "/" + dbvalue[index][1].substr(4,2) + "/" + dbvalue[index][1].substr(6,2) + " " + dbvalue[index][1].substr(8,2) + ":" + dbvalue[index][1].substr(10,2);
				document.getElementById('dia_date').value = idate;
				var sex = "";
				if(dbvalue[index][2] == 1){
				    sex = "男性";
				}
				if(dbvalue[index][2] == 2){
				    sex = "女性";
				}
				document.getElementById('dia_sex').value  = sex;
				document.getElementById('dia_age').value  = dbvalue[index][3];
				document.getElementById('dia_sadness').value  = dbvalue[index][5];
				document.getElementById('dia_joy').value  = dbvalue[index][6];
				document.getElementById('dia_fear').value  = dbvalue[index][7];
				document.getElementById('dia_disgust').value  = dbvalue[index][8];
				document.getElementById('dia_anger').value  = dbvalue[index][9];
				document.getElementById('dia_opinion').innerHTML  = dbvalue[index][4];
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
</script>
</body>
</html>
