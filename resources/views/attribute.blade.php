@extends('layouts.other')

@section('title')
属性登録
@stop

@section('content')
<div class="container">
	<label>{{$test}}</label>
</div>
<div class="container" align="center">
	<input id="btn_del" type="button" class="btn btn-default" value="送信" onclick="send()">
</div>
<input id="_token" type="hidden" name="_token" value="{{ csrf_token() }}">
<script type="text/javascript" src="js/attribute.js"></script>
@endsection