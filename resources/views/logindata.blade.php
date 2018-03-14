@extends('layouts.app')

@section('title')
ログイン情報
@stop

@section('content')
<table id="grid-basic"
	class="table table-condensed table-hover table-striped">

	<thead>
		<tr>
			<th data-column-id="userid" data-width="30%">ユーザー</th>
			<!--  <th data-column-id="icon"  data-width="5%" data-formatter="icons" data-sortable="false"></th>-->
			<th data-column-id="classification" data-width="20%">分類</th>
			<th data-column-id="time" data-width="40%">時間</th>
		</tr>
	</thead>
	<tbody>

		@foreach($logindata as $infomation)
		<tr>
			<td>{{$infomation->userid}}</td>
			 <!--  <td></td> -->
			<td>{{$infomation->classification}}</td>
			<td>{{$infomation->time}}</td>
		</tr>
		@endforeach

	</tbody>
</table>

<script src="{{ asset('js/logindata.js') }}"></script>
@endsection
