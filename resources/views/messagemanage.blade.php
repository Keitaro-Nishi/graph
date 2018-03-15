@extends('layouts.app')

@section('title')
メッセージ管理
@stop

@section('content')
<div class="container">
	<form class="form-horizontal">
		<div class="form-group">
			<label class="col-sm-2 control-label" for="messid">メッセージ種別</label>
			<div class="col-sm-3">
				<select class="form-control" id="messid" onChange="messidChange()">
					@foreach($codes as $value)
					<option value="{{$value->code2}}" selected>{{$value->meisho}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="mess">メッセージ</label>
			<div class="col-sm-10">
				<textarea class="form-control" id="mess" rows='10'></textarea>
			</div>
		</div>
		<input id="_token" type="hidden" name="_token" value="{{ csrf_token() }}">
	</form>
</div>
<div class="container" align="center">
	<input id="btn_up" type="button" class="btn btn-primary" value="更新" onclick="update()">
</div>
<script src="{{ secure_asset('js/messagemanage.js') }}"></script>
<script>
var messages = @json($messages);
init();
</script>
@endsection