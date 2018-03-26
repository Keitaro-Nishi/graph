@extends('layouts.app')

@section('title')
ホーム
@stop

@section('content')
	<div align="center">
	<br>
	<br>
	<br>
	<br>
		<button onclick="location.href='/botlog'" class="button5" type="submit">チャットボットログ</button>
		<br>
		<br>
		<br>
		<button onclick="location.href='/logview'" class="button5" type="submit">フォトログ</button>
		<br>
		<br>
		<br>
		<button onclick="location.href='/logview'" class="button5" type="submit">ランキング</button>
		<br>
		<br>
		<br>
		<button onclick="location.href='/Account'" class="button5 chrome Safari" type="submit">アカウント管理</button>
	</div>
@endsection