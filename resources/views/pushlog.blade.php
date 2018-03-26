@extends('layouts.app')

@section('title')
Lineプッシュログ
@stop

@section('content')
<table id="grid-basic"
	class="table table-condensed table-hover table-striped">
	<thead>
		<tr>
			<th data-column-id="no" data-type="numeric" data-identifier="true" data-width="4%"data-visible="false">NO</th>
			<th data-column-id="time" data-width="10%">日時</th>
			<th data-column-id="target" data-width="10%">対象人数</th>
			<th data-column-id="type" data-width="10%">タイプ</th>
			<th data-column-id="contents" data-width="35%">送信内容</th>
			<th data-column-id="sender" data-width="35%">送信者</th>
			<th data-column-id='detail' data-width='6%' data-formatter='details' data-sortable='false'></th>
		</tr>
	</thead>
	<tbody>
		@foreach($pushlogs as $pushlog)
		<tr>
			<td>{{$pushlog['no']}}</td>
			<td>{{$pushlog['time']}}</td>
			<td>{{$pushlog['target']}}</td>
			<td>{{$pushlog['type']}}</td>
			<td>{{$pushlog['contents']}}</td>
			<td>{{$pushlog['sender']}}</td>
			<td></td>
		</tr>
		@endforeach
	</tbody>
</table>


<input id="pushlog" type= "hidden" value = '{{ $pushlogvalue }}'>
<input id="_token" type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="container" align="center">
	<input id="btn_del" type="button" class="btn btn-default" value="選択行の削除" onclick="drow()">
	<input id="btn_modal" type="button" style="display: none" data-toggle="modal" data-target="#shosaiDialog" value="モーダル表示" />
</div>


<div class="modal" id="shosaiDialog"  tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content" style="width:740px; margin-left: -20px;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="modal-label">対象情報</h4>
			</div>
			<div class="modal-body">

				<div class="container" align="center">
					<form class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-2 control-label" for="dia_number">送信対象者数</label>
							<div class="col-sm-2">
								<input type="text" class="form-control" id="dia_number" readonly>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="dia_register">属性登録有無</label>
							<div class="col-sm-2">
								<input type="text" class="form-control" id="dia_register" readonly>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="dia_age">年齢</label>
							<div class="col-sm-2">
								<input type="text" class="form-control" id="dia_age" readonly>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="dia_sex">性別</label>
							<div class="col-sm-2">
								<input type="text" class="form-control" id="dia_sex" readonly>
							</div>
						</div>
						@foreach($codes as $code)
						<div class="form-group">
							@foreach($code as $value)
							@if($value['code2'] == 0)
							<label class="col-sm-2 control-label" id="optionlabel{{$value['code1']}}" for="option{{$value['code1']}}">{{$value['meisho']}}</label>
							<div class="col-sm-2">
									<input type="text" class="form-control" id="option{{$value['code1']}}" readonly>
							@endif
							@endforeach
							</div>
						</div>
						@endforeach
					</form>
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
			</div>
		</div>
	</div>
</div>

<script src="{{ asset('js/pushlog.js') }}"></script>

@endsection
