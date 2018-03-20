@extends('layouts.other')

@section('title')
パスワード変更
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
						<label class="col-sm-3 control-label" for="dia_userid">ユーザーID</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="dia_userid" name="userid" value="{{$userid}}　　※ログイン時に使用" disabled="disabled" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="dia_name">名前</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="dia_name" name="name" value="{{$name}}" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="dia_oldpassword">現在のパスワード</label>
						<div class="col-sm-9">
							<input type="password" class="form-control" id="dia_oldpassword" name="oldpassword" value="" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="dia_password">新しいパスワード</label>
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
