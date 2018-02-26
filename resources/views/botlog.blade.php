@extends('layouts.app')

@section('title')
チャットボットログ
@stop

@section('content')
<table id="grid-basic"
	class="table table-condensed table-hover table-striped">
	<thead>
		<tr>
			<th data-column-id="no" data-type="numeric" data-identifier="true" data-width="4%">NO</th>
			<th data-column-id="time" data-width="10%">日時</th>
			<th data-column-id="userid" data-width="10%">ユーザーID</th>
			<th data-column-id="contents"  data-width="35%">質問内容</th>
            <th data-column-id="return"  data-width="35%">回答内容</th>
            <th data-column-id='detail'  data-width='6%' data-formatter='details' data-sortable='false'></th>
		</tr>
	</thead>
	<tbody>
		@foreach($botlogs as $botlog)
		<tr>
			<td>{{$botlog->no}}</td>
			<td>{{$botlog->time}}</td>
			<td>{{$botlog->userid}}</td>
			<td>{{$botlog->contents}}</td>
			<td>{{$botlog->return}}</td>
			<!--  <td></td>-->
		</tr>
		@endforeach
	</tbody>
</table>

<div class="container" align="center">
	<input id="btn_del" type="button" class="btn btn-default" value="選択行の削除" onclick="drow()">
</div>

<script>
			var rowIds = [];

			$(function() {
				$("#header").load("header.html");
				$("#grid-basic").bootgrid({
					selection : true,
					multiSelect : true,
					rowSelect : true,
					keepSelection : true,
					/*formatters: {
				        "details": function($column, $row) {
				        	return "<input type='button' value='詳細' onclick='detailwin("  + $row.no + ")'> ";
			             }
				    }*/
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
</script>
@endsection