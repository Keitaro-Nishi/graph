<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>
	@section('title')
	ログイン
	@show
</title>

<!-- Styles -->
<link href="{{ asset('css/common.css') }}" rel="stylesheet">
<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/Buttons.css') }}" rel="stylesheet">
<link href="{{ asset('css/jquery.bootgrid.css') }}" rel="stylesheet">
<link href="{{ asset('css/botui.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/botui-theme-default.css') }}" rel="stylesheet">
<link href="{{ asset('css/home.css') }}" rel="stylesheet">

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/jquery.bootgrid.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

<!-- チャットボット(WEB)用に追加 -->
<script src="//www.promisejs.org/polyfills/promise-6.1.0.min.js"></script>
<script src="//npmcdn.com/vue@2.0.5/dist/vue.min.js"></script>
<script src="//unpkg.com/botui/build/botui.min.js"></script>
<!-- Chart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>



</head>
<body>
	<div id="app">
		<nav class="navbar navbar-default navbar-static-top">
			<div class="container">
				<div class="navbar-header">

					<!-- Collapsed Hamburger -->
					<button type="button" class="navbar-toggle collapsed"
						data-toggle="collapse" data-target="#app-navbar-collapse"
						aria-expanded="false">
						<span class="sr-only">Toggle Navigation</span> <span
							class="icon-bar"></span> <span class="icon-bar"></span> <span
							class="icon-bar"></span>
					</button>
					@guest
					<!-- Branding Image -->
					<a class="navbar-brand" href="{{ url('/login') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a>
					@else
					<!-- Branding Image -->
					<a class="navbar-brand" href="{{ url('/home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a>
					@endguest
				</div>
				<div class="collapse navbar-collapse" id="app-navbar-collapse">
					<!-- Left Side Of Navbar -->
					<ul class="nav navbar-nav">&nbsp;
					</ul>

					<!-- Right Side Of Navbar -->
					<ul class="nav navbar-nav navbar-right">
						<!-- Authentication Links -->
						@auth
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">Menu
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li><a href="{{ route('botlog') }}">ログ参照</a></li>
								<li><a href="{{ route('logimage') }}">画像ログ参照</a></li>
								<li><a href="{{ route('facility') }}">施設情報</a></li>
								<li><a href="{{ route('genre') }}">施設ジャンル</a></li>
								<li><a href="{{ route('opinion') }}">ご意見ログ</a></li>
								<li><a href="{{ route('register') }}">属性情報</a></li>
								<li><a href="{{ route('linepush') }}">LINEプッシュ通知</a></li>
								<li><a href="{{ route('pushlog') }}">LINEプッシュログ</a></li>
								<li><a href="{{ route('messagemanage') }}">メッセージ管理</a></li>
								<li><a href="{{ route('webbot') }}">チャットボット WEB</a></li>
								@if (Auth::user()->role == 0 or Auth::user()->role == 1)
								<li><a href="{{ route('register') }}">セッション情報</a></li>
								<li><a href="{{ route('codemanage') }}">コード管理</a></li>
								<li><a href="{{ route('parameter') }}">市町村パラメタ</a></li>
								@endif
							</ul>
						</li>

						<li class="dropdown"><a href="#" class="dropdown-toggle"
							data-toggle="dropdown" role="button" aria-expanded="false"
							aria-haspopup="true">
							<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
						</a>

							<ul class="dropdown-menu">
								@if (Auth::user()->role == 0 or Auth::user()->role == 1)
								<li><a href="{{ route('users') }}">ユーザー管理</a></li>
								<li><a href="{{ route('logindata') }}">ログイン情報</a></li>
								@endif
								<li><a href="{{ route('usersetting') }}">パスワード変更</a></li>
								<li><a href="{{ route('logout') }}" onclick="event.preventDefault();
									document.getElementById('logout-form').submit();">ログアウト</a>

									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
								</li>
							</ul>
						</li>
						@endauth
				</div>
			</div>
		</nav>
		@yield('content')
	</div>
</body>
</html>
