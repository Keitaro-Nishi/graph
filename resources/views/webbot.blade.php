@extends('layouts.app')

@section('title')
ウェブチャットボット
@stop

@section('content')

<div class="container">
	<h1>ウェブチャットボット</h1>
	<input id="btn_clear" type="button" class="btn btn-default" value="クリア" onclick="dispclear()">
	<div class="botui-app-container" id="chat-app">
    	<bot-ui></bot-ui>
	</div>
</div>


<script src="{{ asset('js/webbot.js') }}"></script>
@endsection
