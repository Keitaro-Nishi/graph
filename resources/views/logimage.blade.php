@extends('layouts.app')

@section('title')
チャットボット画像ログ
@stop

@section('content')
<table id="grid-basic"
	class="table table-condensed table-hover table-striped">
	<thead>
		<tr>
			<th data-column-id="no" data-type="numeric" data-identifier="true"
				data-width="4%" data-visible="false">NO</th>
			<th data-column-id='time' data-identifier="true">日時</th>
			<th data-column-id='userid'>ユーザーID</th>
			<th data-column-id='image' data-formatter='image'>送信画像</th>
			<th data-column-id='cls'>分類</th>
			<th data-column-id='scr'>確信度</th>
			<th data-column-id='zm' data-width='7%' data-formatter='zoom'
				data-sortable='false'></th>
		</tr>
	</thead>
	<tbody>
		@foreach($logimages as $logimage)
		<tr>
			<td>{{$logimage->no}}</td>
			<td>{{ Carbon\Carbon::parse($logimage->time)->format('Y/m/d H:i:s') }}</td>
			<td>{{$logimage->userid}}</td>
			<td></td>
			<td>{{$logimage->class}}</td>
			<td>{{$logimage->score}}</td>
			<td></td>
		</tr>
		@endforeach
	</tbody>
</table>
<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
<div class="container" align="center">
	<input id="btn_del" type="button" class="btn btn-default" value="選択行の削除" onclick="drow()">
	<input id="btn_modal" type="button" style="display: none" data-toggle="modal" data-target="#image_Modal" value="モーダル表示" />
</div>
<div class="modal" id="image_Modal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content" id="dia_cont">
			<div class="modal-body" align="center">
				<p id="dia_kaku"></p>
				<img id="dia_image" />
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
			</div>
		</div>
	</div>
</div>
<script src="{{ asset('js/logimage.js') }}"></script>
<script>
init();
</script>
@endsection
