@extends('layouts.app')

@section('title') 施設管理 @stop

@section('content')
<table id="grid-basic"
	class="table table-condensed table-hover table-striped">
	<thead>
		<tr>
			<th data-column-id="id" data-identifier="true" data-visible="false">ID</th>
			<th data-column-id="meisho">名称</th>
			<th data-column-id="jusho">住所</th>
			<th data-column-id="tel">電話番号</th>
			<th data-column-id="genre1">ジャンル１</th>
			<th data-column-id="genre2">ジャンル2</th>
			<th data-column-id="lat">緯度</th>
			<th data-column-id="lng">経度</th>
			<th data-column-id="imageurl">画像URL</th>
			<th data-column-id="url">詳細URL</th>
			<th data-column-id='detail' data-formatter='mods'
				data-sortable='false'></th>
		</tr>
	</thead>
	<tbody>
		@foreach($facilities as $facility)
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
					<div class="form-group" style="display: none">
						<label class="col-sm-2 control-label" for="dia_id">id</label>
						<div class="col-sm-10">
							<input id="dia_id" class="form-control" name="id" value="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_meisho">施設名称</label>
						<div class="col-sm-10">
							<input id="dia_meisho" class="form-control" maxlength="40"
								name="meisho" value="" placeholder="行政公園">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_jusho">住所</label>
						<div class="col-sm-10">
							<input id="dia_jusho" class="form-control" maxlength="128"
								name="jusho" value="" placeholder="行政市行政1-1-1">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_tel">電話番号</label>
						<div class="col-sm-10">
							<input id="dia_tel" class="form-control" type="tel" name="tel"
								value="" maxlength="14" placeholder="000-000-0000">
						</div>
					</div>
					<div class="form-group">
						<select class="form-control" id="codesel" onChange="codeselChange()">
						@foreach($genrel as $value)
							<option value="{{$value->bunrui}}" selected>{{$value->meisho}}</option>
						@endforeach
						</select>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_genre2">ジャンル２</label>
						<div class="col-sm-10">
							<select class="form-control" id="dia_genre2" name="genre2">
								<option value=0>ジャンル無し</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_latlng">緯度・経度</label>
						<div class="col-sm-10">
							<input id="dia_latlng" class="form-control" maxlength="33"
								name="latlng" value="" placeholder="999.99999,999.99999"> <input
								type="button" class="btn btn-default" style="display: inline;"
								onclick="map()" value="地図の確認" style="width: 100px;" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_imageurl">画像ＵＲＬ</label>
						<div class="col-sm-10">
							<input id="dia_imageurl" class="form-control" name="imageurl"
								value="" maxlength="300" placeholder="https://www.yyy.zzz.jpg">
							<input type="button" class="btn btn-default"
								style="display: inline; width: 100px;" onclick="image()"
								value="画像の確認" /> ※必ずhttpsから始まるURLを指定してください
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_url">詳細ＵＲＬ</label>
						<div class="col-sm-10">
							<input id="dia_url" class="form-control" maxlength="300"
								name="url" value="" placeholder="http://www.yyy.zzz.html">
						</div>
					</div>
					<input type="hidden" id="_token" name="_token"
						value="{{ csrf_token() }}">
					<div class="text-right">
						<button type="button" class="btn btn-primary" onclick="update()">登録</button>
						<button id="dia_close" type="button" class="btn btn-default"
							data-dismiss="modal">閉じる</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@if (Auth::user()->citycode != 00000)
<div class="container" align="center">
	<input id="btn_del" type="button" class="btn btn-default"
		value="選択行の削除" onclick="drow()"> <input id="btn_ins" type="button"
		class="btn btn-default" value="施設登録" onclick="insert()"> <input
		id="btn_modal" type="button" style="display: none" data-toggle="modal"
		data-target="#shosaiDialog" />
</div>
@else
<div class="container" align="center">
	<input id="btn_del" type="button" class="btn btn-default"
		value="選択行の削除" onclick="drow()">
</div>
@endif
<script src="{{ asset('js/facility.js') }}"></script>

@endsection