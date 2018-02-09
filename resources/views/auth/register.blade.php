@extends('layouts.app')

@section('content')
<div class="container">

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">ユーザー登録</div>

				<div class="panel-body">
					<form class="form-horizontal" method="POST" action="{{ route('register') }}">
					{{ csrf_field() }}

						@if (Auth::user()->role == (int)1 )
						<div style="display: none">
						@endif


						@if (Auth::user()->role == (int)0 )
							<div class="form-group{{ $errors->has('citycode') ? ' has-error' : '' }}">
							<label for="citycode" class="col-md-4 control-label">市町村コード</label>

								<div class="col-md-6">
									<input id="citycode" type="text" class="form-control" name="citycode" value="{{ old('citycode') }}" required autofocus>

									@if ($errors->has('citycode'))
										<span class="help-block">
												<strong>{{ $errors->first('citycode') }}</strong>
										</span>
									@endif
								</div>
							</div>
						@endif

						@if (Auth::user()->role == (int)1 )
							<div class="form-group{{ $errors->has('citycode') ? ' has-error' : '' }}">
							<label for="citycode" class="col-md-4 control-label"></label>

								<div class="col-md-6">
									<input id="citycode" type="hidden" class="form-control" name="citycode" value="{{Auth::user()->citycode}}" required autofocus>

									@if ($errors->has('citycode'))
										<span class="help-block">
												<strong>{{ $errors->first('citycode') }}</strong>
										</span>
									@endif
								</div>
							</div>
						@endif

						@if (Auth::user()->role == (int)1 )
						</div>
						@endif


						<div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
							<label for="role" class="col-md-4 control-label"></label>

								<div class="col-md-6">
									<input id="role" type="hidden" class="form-control" name="role" value="{{Auth::user()->role}}" required autofocus>

									@if ($errors->has('citycode'))
										<span class="help-block">
												<strong>{{ $errors->first('role') }}</strong>
										</span>
									@endif
								</div>
						</div>


						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							<label for="name" class="col-md-4 control-label">ユーザー名</label>

							<div class="col-md-6">
								<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>

 								@if ($errors->has('name'))
									<span class="help-block">
										<strong>{{ $errors->first('name') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('userid') ? ' has-error' : '' }}">
							<label for="userid" class="col-md-4 control-label">組織名</label>

							<div class="col-md-6">
								<input id="userid" type="text" class="form-control" name="userid" value="{{ old('userid') }}" required>

								@if ($errors->has('userid'))
									<span class="help-block">
										<strong>{{ $errors->first('userid') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('organization') ? ' has-error' : '' }}">
							<label for="organization" class="col-md-4 control-label">ユーザーID</label>

							<div class="col-md-6">
								<input id="organization" type="text" class="form-control" name="organization" value="{{ old('organization') }}" required>

								@if ($errors->has('organization'))
									<span class="help-block">
										<strong>{{ $errors->first('organization') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
							<label for="password" class="col-md-4 control-label">パスワード</label>

							<div class="col-md-6">
								<input id="password" type="password" class="form-control" name="password" required>

								@if ($errors->has('password'))
									<span class="help-block">
										<strong>{{ $errors->first('password') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group">
							<label for="password-confirm" class="col-md-4 control-label">パスワードの再入力</label>

							<div class="col-md-6">
								<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									登録
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection