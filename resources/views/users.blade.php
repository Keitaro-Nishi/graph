@extends('layouts.app')
<!--
@section('content')
 -->
<table id="grid-basic"
	class="table table-condensed table-hover table-striped">
	<thead>
		<tr>
			<th data-column-id="name" data-width="10%">ユーザー名</th>
			<th data-column-id="userid" data-identifier="true" data-width="10%">ユーザーID</th>
			<th data-column-id="organization" data-width="10%">組織名</th>
			<th data-column-id="role" data-width="3%">役割</th>
		</tr>
	</thead>
	<tbody>
		@foreach($users as $user)
		<tr>
			<td>{{$user->name}}</td>
			<td>{{$user->userid}}</td>
			<td>{{$user->organization}}</td>
			<td>{{$user->role}}</td>
		</tr>
		@endforeach
	</tbody>
</table>

<div class="container" align="center">
	<input id="btn_del" type="button" class="btn btn-default" value="選択行の削除" onclick="drow()">
</div>

<!--
@endsection
@include('common._script')
-->