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
		<button onclick="location.href='/botlog'" class="homebutton" type="submit">ログ参照</button>
		<button onclick="location.href='/logimage'" class="homebutton" type="submit">画像ログ参照</button>
		<button onclick="location.href='/facility'" class="homebutton" type="submit">施設情報</button>
		<button onclick="location.href='/genre'" class="homebutton" type="submit">施設ジャンル</button>
		<br>
		<br>
		<br>
		<button onclick="location.href='/opinion'" class="homebutton" type="submit">ご意見ログ</button>
		<button onclick="location.href='/linepush'" class="homebutton" type="submit">LINEプッシュ通知</button>
		<button onclick="location.href='/pushlog'" class="homebutton" type="submit">LINEプッシュログ</button>
		<button onclick="location.href='/messagemanage'" class="homebutton" type="submit">メッセージ管理</button>
		<button onclick="location.href='/webbot'" class="homebutton" type="submit">チャットボット WEB</button>
		<br>
		<br>
		<br>
		@if (Auth::user()->role == 0 or Auth::user()->role == 1)
		<button onclick="location.href='/codemanage'" class="homebutton" type="submit">コード管理</button>
		<button onclick="location.href='/parameter'" class="homebutton" type="submit">市町村パラメタ</button>
		@endif
		<br>
		<br>
		<br>
	</div>

@endsection