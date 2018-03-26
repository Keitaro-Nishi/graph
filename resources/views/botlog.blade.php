@extends('layouts.app')

@section('title')
チャットボットログ
@stop

@section('content')
<table id="grid-basic"
	class="table table-condensed table-hover table-striped">
	<thead>
		<tr>
			<th data-column-id="no" data-type="numeric" data-identifier="true" data-width="4%"data-visible="false">NO</th>
			<th data-column-id="userid" data-width="8%">ユーザーID</th>
			<th data-column-id="time" data-width="12%">日時</th>
			<th data-column-id="contents" data-width="35%">質問内容</th>
			<th data-column-id="returns" data-width="35%">回答内容</th>
			<th data-column-id='detail' data-width='6%' data-formatter='details' data-sortable='false'></th>
		</tr>
	</thead>
	<tbody>
		@foreach($botlogs as $botlog)
		<tr>
			<td>{{$botlog['no']}}</td>
			<td>{{$botlog['userid']}}</td>
			<td>{{$botlog['time']}}</td>
			<td>{{$botlog['contents']}}</td>
			<td>{{$botlog['return']}}</td>
			<td></td>
		</tr>
		@endforeach
	</tbody>
</table>


<input id="botlog" type= "hidden" value = '{{ $botlogvalue }}'>


<div class="container" align="center">
	<input id="btn_del" type="button" class="btn btn-default" value="選択行の削除" onclick="drow()">
	<input id="btn_modal" type="button" style="display: none" data-toggle="modal" data-target="#shosaiDialog" value="モーダル表示" />
</div>

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
					<div class="form-group"  style="display:none">
						<label class="col-sm-2 control-label" for="dia_no">no</label>
						<div class="col-sm-10">
							<input id="dia_no" class="form-control" name="no" value="">
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
							<input type="text" class="form-control" id="dia_time" readonly>
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
			<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
			<div class="modal-footer">
				<button id="sback" type="button" class="btn btn-default" onclick="shosai_back()">＜＜前へ</button>
				<button id="snext" type="button" class="btn btn-default" onclick="shosai_next()">次へ＞＞</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
			</div>
		</div>
	</div>
</div>

<script src="{{ asset('js/botlog.js') }}"></script>

@endsection