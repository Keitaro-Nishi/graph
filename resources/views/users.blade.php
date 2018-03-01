@extends('layouts.app')

@section('title')
ユーザー管理
@stop

@section('content')
<table id="grid-basic"
	class="table table-condensed table-hover table-striped">
	<thead>
		<tr>
			<th data-column-id="name">ユーザー名</th>
			<th data-column-id="userid" data-identifier="true">ユーザーID</th>
			<th data-column-id="organization">組織名</th>
			<th data-column-id="role">役割</th>
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
<div class="modal" id="shosaiDialog" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content" style="width: 740px; margin-left: -20px;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="modal-label">ユーザー登録</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal">
					@if (Auth::user()->role == (int)0 )
					<div class="form-group">
						<label class="col-sm-3 control-label" for="dia_citycode">市町村コード</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="dia_citycode" name="citycode" value="" required autofocus>
						</div>
					</div>
					@endif
					<div class="form-group">
						<label class="col-sm-3 control-label" for="dia_userid">ユーザーＩＤ</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="dia_userid" name="userid" value="" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="dia_name">ユーザー名</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="dia_name" name="name" value="" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="dia_organization">所属</label>
						<div class="col-sm-9">
							<select class="form-control" id="dia_organization" name="organization">
								<option value=0>所属なし</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="dia_password">パスワード</label>
						<div class="col-sm-9">
							<input type="password" class="form-control" id="dia_password" name="password" value="" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="dia_password_confirmation">パスワード再入力</label>
						<div class="col-sm-9">
							<input type="password" class="form-control" id="dia_password_confirmation" name="password_confirmation" value="" required>
						</div>
					</div>
					<input id="_token" type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="text-right" >
						<button type="button" class="btn btn-primary" onclick="update()">登録</button>
						<button id="dia_close" type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="container" align="center">
	<input id="btn_del" type="button" class="btn btn-default" value="選択行の削除" onclick="drow()">
	<input id="btn_ins" type="button" class="btn btn-default" value="ユーザー登録" onclick="insert()">
	<input id="btn_modal" type="button" style="display:none" data-toggle="modal"  data-target="#shosaiDialog"/>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
<script src="{{ asset('js/users.js') }}"></script>

@endsection