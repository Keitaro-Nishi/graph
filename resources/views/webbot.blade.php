@extends('layouts.app')

@section('title')
チャットボット(WEB)
@stop

@section('content')

<div class="container">
	<h1>チャットボット(WEB)</h1>
	<input id="btn_clear" type="button" class="btn btn-default" value="クリア" onclick="dispclear()">
	<div class="botui-app-container" id="chat-app">
    	<bot-ui></bot-ui>
	</div>
</div>

<input id="citycode" value = '{{ $citycode }}'>
<input id="name"  value = '{{ $name }}'>

<script src="{{ asset('js/webbot.js') }}"></script>
@endsection
