@extends('layouts.app')

@section('content')
<table id="grid-basic"
	class="table table-condensed table-hover table-striped">
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
<div class="modal" id="shosaiDialog" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content" style="width: 740px; margin-left: -20px;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="modal-label">詳細</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_id">ID</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="dia_id" value="" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_userid">ユーザーID</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="dia_userid" value="" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_time">日時</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="dia_time" value="" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_contents">質問</label>
						<div class="col-sm-10">
							<textarea class="form-control" id="dia_contents" rows='5' readonly></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_return">回答</label>
						<div class="col-sm-10">
							<textarea class="form-control" id="dia_return" rows='5' readonly></textarea>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button id="sback" type="button" class="btn btn-default"
					onclick="shosai_back()">＜＜前へ</button>
				<button id="snext" type="button" class="btn btn-default"
					onclick="shosai_next()">次へ＞＞</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
			</div>
		</div>
	</div>
</div>


<div class="container" align="center">
	<input id="btn_del" type="button" class="btn btn-default" value="選択行の削除" onclick="drow()">
	<input id="btn_ins" type="button" class="btn btn-default" value="施設の追加" onclick="irow()">
	<input id="btn_modal" type="button" style="display: none" data-toggle="modal" data-target="#shosaiDialog" value="モーダル表示" />
</div>

<!-- 登録Modal -->
<div class="modal" id="shosaiDialog" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content" style="width: 740px; margin-left: -20px;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="modal-label">施設登録</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_meisho">施設名称</label>
						<div class="col-sm-10">
							<input id="dia_meisho" class="form-control" maxlength="40" placeholder="行政公園">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_jusho">住所</label>
						<div class="col-sm-10">
							<input id="dia_jusho" class="form-control" maxlength="128" placeholder="行政市行政1-1-1">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_tel">電話番号</label>
						<div class="col-sm-10">
							<input id="dia_tel" class="form-control" type="tel" maxlength="14" placeholder="000-000-0000">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_j1">ジャンル１</label>
						<div class="col-sm-10">
							<select class="form-control" id="dia_j1" onChange="j1change()">
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_j2">ジャンル２</label>
						<div class="col-sm-10">
							<select class="form-control" id="dia_j2">
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_latlng">緯度・経度</label>
						<div class="col-sm-10">
							<input id="dia_latlng" class="form-control" maxlength="33" placeholder="999.99999,999.99999">
							<input type="button" class="btn btn-default" style="display: inline; width: 100px;" onclick="map()" value="地図の確認"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_iurl">画像ＵＲＬ</label>
						<div class="col-sm-10">
							<input id="dia_iurl" class="form-control" maxlength="300" placeholder="https://www.yyy.zzz.jpg">
							<input type="button" class="btn btn-default" style="display: inline;" onclick="image()" value="画像の確認" style="width: 100px;" />
							※必ずhttpsから始まるURLを指定してください
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_url">詳細ＵＲＬ</label>
						<div class="col-sm-10">
							<input id="dia_url" class="form-control" maxlength="300"
								placeholder="http://www.yyy.zzz.html">
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" onclick="update()">更新</button>
				<button id="dia_close" type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
			</div>
		</div>
	</div>
</div>

<script>
var rowIds = [];
var dbvalue = [];
var shosai_idx = 0;
$(function() {
	$("#grid-basic").bootgrid({
		selection : true,
		multiSelect : true,
		keepSelection : true,
		formatters: {
	        "details": function($column, $row) {
	        	return "<input type='button' value='詳細' onclick='detailwin("  + $row.id + ")'> ";
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
</script>
@endsection
