@extends('layouts.app')

@section('content')
<table id="grid-basic"
	class="table table-condensed table-hover table-striped">
	<thead>
		<tr>
			   <th data-column-id='bunrui' >分類</th>
               <th data-column-id='g1'  >大分類名称</th>
               <th data-column-id='g2'  >小分類名称</th>
               <th data-column-id='gid1' data-order='desc'>分類ID1</th>
               <th data-column-id='gid2'>分類ID2</th>
               <th data-column-id='mod'  data-width='7%' data-formatter='mods' data-sortable='false'></th>
		</tr>
	</thead>
	<tbody>
		@foreach($genres as $genre)
		<tr>
			@if($genre->bunrui == 1)
			<td>大分類</td>
			@else
			<td>小分類</td>
			@endif
			@if($genre->bunrui == 1)
			<td>{{$genre->meisho}}</td>
			@else
			<td></td>
			@endif
			@if($genre->bunrui == 1)
			<td>-</td>
			@else
			<td>{{$genre->meisho}}</td>
			@endif
			<td>{{$genre->gid1}}</td>
			<td>{{$genre->gid2}}</td>
		</tr>
		@endforeach
	</tbody>
</table>

<div class="container" align="center">
	<input id="btn_del" type="button" class="btn btn-default" value="選択行の削除" onclick="drow()">
	<input id="btn_ins" type="button" class="btn btn-default" value="ジャンルの追加" onclick="irow()">
	<input id="btn_int" type="button" class="btn btn-default" value="検索ワード追加" onclick="intent()">
	<input id="btn_int" type="button" class="btn btn-default" value="類義語追加" onclick="entity()">
	<input id="btn_modal" type="button" style="display:none" data-toggle="modal"  data-target="#shosaiDialog" value="モーダル表示" />
</div>

<div>
<input id="result" type= "text" value = '{{ $result2 }}'>
</div>

<div class="modal" id="shosaiDialog"  tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content" style="width:740px; margin-left: -20px;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="modal-label">ジャンル登録</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_bunrui">分類</label>
						<div class="col-sm-10">
							<select class="form-control" id="dia_bunrui"  onChange="bchange()">
								<option value="1">大分類</option>
								<option value="2">小分類</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_g1meisho">大分類名称</label>
						<div class="col-sm-10">
							<input id="dia_g1meisho" class="form-control" maxlength="50" placeholder="大分類名称">
							<select id="dia_g1" class="form-control">
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_tel">小分類名称</label>
						<div class="col-sm-10">
							<input id="dia_g2meisho" class="form-control" maxlength="50" placeholder="小分類名称">
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

<script src="{{ asset('js/genre.js') }}"></script>
@endsection
