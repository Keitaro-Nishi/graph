@extends('layouts.app')

@section('title')
ログイン情報
@stop

@section('content')
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
			<td>{{$infomation->time}}</td>
		</tr>
		@endforeach

	</tbody>
</table>

<input id="_token" type="hidden" name="_token" value="{{ csrf_token() }}">

<script src="{{ asset('js/logindata.js') }}"></script>
@endsection
