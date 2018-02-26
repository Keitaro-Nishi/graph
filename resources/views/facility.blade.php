@extends('layouts.app')

@section('content')
<table id="grid-basic" class="table table-condensed table-hover table-striped">
	<thead>
		<tr>
			<th data-column-id="id" data-type="numeric" data-identifier="true">ID</th>
			<th data-column-id="meisho">名称</th>
			<th data-column-id="jusho">住所</th>
			<th data-column-id="tel">電話番号</th>
			<th data-column-id="genre1">ジャンル１</th>
			<th data-column-id="genre2">ジャンル2</th>
			<th data-column-id="lat">緯度</th>
			<th data-column-id="lng">経度</th>
			<th data-column-id="imageurl">画像URL</th>
			<th data-column-id="url">詳細URL</th>
			<th data-column-id='detail' data-formatter='details' data-sortable='false'></th>
		</tr>
	</thead>
	<tbody>
		@foreach($facilitys as $facility)
		<tr>
			<td>{{$facility->id}}</td>
			<td>{{$facility->meisho}}</td>
			<td>{{$facility->jusho}}</td>
			<td>{{$facility->tel}}</td>
			<td>{{$facility->genre1}}</td>
			<td>{{$facility->genre2}}</td>
			<td>{{$facility->lat}}</td>
			<td>{{$facility->lng}}</td>
			<td>{{$facility->imageurl}}</td>
			<td>{{$facility->url}}</td>
			<td></td>
		</tr>
		@endforeach
	</tbody>
</table>

<!-- botlog 29~81 -->

<div class="container" align="center">
	<input id="btn_del" type="button" class="btn btn-default" value="選択行の削除" onclick="drow()">
	<input id="btn_modal" type="button" style="display: none" data-toggle="modal" data-target="#shosaiDialog" value="モーダル表示" />
</div>

<script>
			var rowIds = [];
			$(function() {
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