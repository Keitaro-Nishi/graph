@extends('layouts.other')

@section('title')
属性登録
@stop

@section('content')

<div class="container" align="center">
	<input type="button" class="btn btn-default" value="削除" onclick="delete()">
	<input type="button" class="btn btn-primary" value="登録" onclick="update()">
</div>
<input id="_token" type="hidden" name="_token" value="{{ csrf_token() }}">
<script type="text/javascript" src="js/attribute.js"></script>
@endsection