@extends('layouts.app')

@section('title')
パラメタ設定
@stop

@section('content')
<div class="container">
	<form class="form-horizontal">
		<div class="form-group">
			<label class="col-sm-2 control-label" for="cityname">団体名</label>
			<div class="col-sm-10">
				<input type="text" class="form-control"  maxlength="30" id="cityname" value="{{$parameter->cityname}}">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="line_cat">LINEチャネルアクセスTOKEN</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="line_cat" value="{{$parameter->line_cat}}">
			</div>
		</div>
		<input id="_token" type="hidden" name="_token" value="{{ csrf_token() }}">
	</form>
</div>
<div class="container" align="center">
	<input id="btn_up" type="button" class="btn btn-primary" value="更新" onclick="update()">
</div>
<script src="{{ asset('js/parameter.js') }}"></script>
@endsection