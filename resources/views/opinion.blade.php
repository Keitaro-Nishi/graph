@extends('layouts.app')

@section('title')
ご意見ログ
@stop

@section('content')
<table id="grid-basic" class="table table-condensed table-hover table-striped">
	<thead>
		<tr>
			<th data-column-id='id' data-type='numeric' data-identifier='true' data-width='3%' data-visible="false"></th>
			<th data-column-id='userid' data-width='9%'>ユーザーID</th>
			<th data-column-id='time'  data-width='13%'>日時</th>
			<th data-column-id='opinion'  data-width='30%'>ご意見</th>
			<th data-column-id='sadness' data-type='numeric' data-width='7%'>悲しみ</th>
			<th data-column-id='joy' data-type='numeric' data-width='7%'>喜び</th>
			<th data-column-id='fear' data-type='numeric' data-width='7%'>恐れ</th>
			<th data-column-id='disgust' data-type='numeric' data-width='7%'>嫌悪</th>
			<th data-column-id='anger' data-type='numeric' data-width='7%'>怒り</th>
			<th data-column-id='checked'  data-width='5%'>チェック</th>
			<th data-column-id='detail'  data-width='5%' data-formatter='details' data-sortable='false'></th>
		</tr>
	</thead>
	<tbody>
		@foreach($opinions as $opinion)
		<tr>
			<td>{{$opinion['id']}}</td>
			<td>{{$opinion['userid']}}</td>
			<td>{{$opinion['time']}}</td>
			<td>{{$opinion['opinion']}}</td>
			<td>{{$opinion['sadness']}}</td>
			<td>{{$opinion['joy']}}</td>
			<td>{{$opinion['fear']}}</td>
			<td>{{$opinion['disgust']}}</td>
			<td>{{$opinion['anger']}}</td>
			<td>{{$opinion['checked']}}</td>
			<td></td>
		</tr>
		@endforeach
	</tbody>
</table>

<input id="opinion" type= "hidden" value = '{{ $opinionvalue }}'>

<input id="_token" type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="container" align="center">
	<input id="btn_del" type="button" class="btn btn-default" value="選択行の削除" onclick="drow()">
	<input id="btn_modal" type="button" style="display:none" data-toggle="modal"  data-target="#shosaiDialog" value="モーダル表示" />
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
					<div id="disp">
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
							<label class="col-sm-2 control-label" for="dia_checked">チェック</label>
							<div class="col-sm-2">
								<input type="text" class="form-control" id="dia_checked" readonly>
							</div>
						</div>
					</div>
				</form>
			</div>
			<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
			<div>
				<canvas id="myChart" width="150" height="100"></canvas>
			</div>
			<div class="modal-footer">
				<button id="sback" type="button" class="btn btn-default" onclick="shosai_back()">＜＜前へ</button>
				<button id="snext" type="button" class="btn btn-default" onclick="shosai_next()">次へ＞＞</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
			</div>
		</div>
	</div>
</div>

<script src="{{ asset('js/opinion.js') }}"></script>

@endsection