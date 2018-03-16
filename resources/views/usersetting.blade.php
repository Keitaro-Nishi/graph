@extends('layouts.app')

@section('title')
a
@stop

@section('content')
<div class="container">

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">ユーザー</div>

				<div class="panel-body">
					<form class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-3 control-label" for="dia_userid">ユーザーＩＤ</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="dia_userid" name="userid" value="" required>
						</div>
					</div>
					<div class="form-group" id="dia_passres">
						<label class="col-sm-3 control-label" for="dia_passresck">パスワード再設定</label>
						<div class="col-sm-9">
							<input type="checkbox" class="form-check-input" id="dia_passresck" name="passresck" onclick="preset()">
							<label class="form-check-label" for="dia_passresck">再設定</label>
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
					<div class="form-group" id="dia_info">
						<label class="col-sm-3 control-label" for="dia_infolabel"></label>
						<div class="col-sm-9">
							<label class="control-label" id="dia_infolabel"></label>
						</div>
					</div>
					<input id="_token" type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="text-right" >
						<button type="button" class="btn btn-primary" onclick="update()">変更</button>
					</div>
				</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="{{ asset('js/usersetting.js') }}"></script>
@endsection