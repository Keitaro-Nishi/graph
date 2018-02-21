@extends('layouts.app')

@section('content')
<table id="grid-basic"
	class="table table-condensed table-hover table-striped">
	<thead>
		<tr>
			   <th data-column-id='id' data-type='numeric' data-identifier='true' data-width='3%'></th>
			   <th data-column-id='userid' data-width='7%'>ユーザーID</th>
               <th data-column-id='time'  data-width='10%'>日時</th>
               <th data-column-id='opinion'  data-width='30%'>ご意見</th>
               <th data-column-id='sadness' data-type='numeric' data-width='9%'>悲しみ</th>
               <th data-column-id='joy' data-type='numeric' data-width='9%'>喜び</th>
               <th data-column-id='fear' data-type='numeric' data-width='9%'>恐れ</th>
               <th data-column-id='disgust' data-type='numeric' data-width='9%'>嫌悪</th>
               <th data-column-id='anger' data-type='numeric' data-width='9%'>怒り</th>
               <th data-column-id='checked'  data-width='5%'>チェック</th>
               <th data-column-id='detail'  data-width='5%' data-formatter='details' data-sortable='false'></th>
		</tr>
	</thead>
	<tbody>
		@foreach($opinions as $opinion)
		<tr>
			<td>{{$opinion->id}}</td>
			<td>{{$opinion->userid}}</td>
			<td>{{$opinion->time}}</td>
			<td>{{$opinion->opinion}}</td>
			<td>{{$opinion->sadness}}</td>
			<td>{{$opinion->joy}}</td>
			<td>{{$opinion->fear}}</td>
			<td>{{$opinion->disgust}}</td>
			<td>{{$opinion->anger}}</td>
			<td>{{$opinion->checked}}</td>
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
					<div class="form-group" style="display:none">
						<label class="col-sm-2 control-label" for="dia_id">ID</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="dia_id" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_userid">ユーザーID</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="dia_userid" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_time">日時</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="dia_time" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_opinion">ご意見</label>
						<div class="col-sm-10">
							<textarea class="form-control" id="dia_opinion" rows='5' readonly></textarea>
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
				//$("#header").load("header.html");
				$("#grid-basic").bootgrid({
					selection : true,
					multiSelect : true,
					rowSelect : true,
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
				document.getElementById('dia_id').value  = dbvalue[index][0];
				document.getElementById('dia_userid').value  = dbvalue[index][1];
				document.getElementById('dia_time').value  = dbvalue[index][2];
				document.getElementById('dia_opinion').innerHTML  = dbvalue[index][3];
				document.getElementById('dia_sadness').value  = dbvalue[index][4];
				document.getElementById('dia_joy').value  = dbvalue[index][5];
				document.getElementById('dia_fear').value  = dbvalue[index][6];
				document.getElementById('dia_disgust').value  = dbvalue[index][7];
				document.getElementById('dia_anger').value  = dbvalue[index][8];

				//var idate = dbvalue[index][1].substr(0,4) + "/" + dbvalue[index][1].substr(4,2) + "/" + dbvalue[index][1].substr(6,2) + " " + dbvalue[index][1].substr(8,2) + ":" + dbvalue[index][1].substr(10,2);
				//document.getElementById('dia_date').value = idate;


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
@endsection
