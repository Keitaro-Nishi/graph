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
			<td>{{$pushlog->no}}</td>
			<td>{{$pushlog->time}}</td>
			<td>{{$pushlog->target}}</td>
			<td>{{$pushlog->type}}</td>
			<td>{{$pushlog->contents}}</td>
			<td>{{$pushlog->sender}}</td>
			<td></td>
		</tr>
		@endforeach
	</tbody>
</table>


<input id="botlog" type= "hidden" value = '{{ $botlogs }}'>
<input id="_token" type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="container" align="center">
	<input id="btn_del" type="button" class="btn btn-default" value="選択行の削除" onclick="drow()">
	<input id="btn_modal" type="button" style="display: none" data-toggle="modal" data-target="#shosaiDialog" value="モーダル表示" />
</div>



<script src="{{ asset('js/pushlog.js') }}"></script>

@endsection
