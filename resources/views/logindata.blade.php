@extends('layouts.app')

@section('title')
ログイン情報
@stop

@section('content')
<div class="container">
<table id="grid-basic"
	class="table table-condensed table-hover table-striped">

	<thead>
		<tr>
			<th data-column-id='id' data-type='numeric' data-identifier='true' data-width='5%' data-visible="false"></th>
			<th data-column-id='userid' data-width='30%'>ユーザー</th>
			<th data-column-id='classification' data-width='25%'>分類</th>
			<th data-column-id='time' data-width='40%'>時間</th>
		</tr>
	</thead>
	<tbody>

		@foreach($logindata as $infomation)
		<tr>
			<td>{{$infomation->id}}</td>
			<td>{{$infomation->userid}}</td>
			<td>{{$infomation->classification}}</td>
			<td>{{ Carbon\Carbon::parse($infomation->time)->format('Y/m/d H:i:s') }}</td>
		</tr>
		@endforeach

	</tbody>
</table>
</div>

<input id="_token" type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="container" align="center">
	<input id="btn_del" type="button" class="btn btn-default" value="選択行の削除" onclick="drow()">
</div>

<script src="{{ asset('js/logindata.js') }}"></script>
@endsection
