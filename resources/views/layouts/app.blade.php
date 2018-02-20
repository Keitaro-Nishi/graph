<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
	<div id="app">
		<!-- ヘッダーカラーチェンジ↓ https://torina.top/detail/172/ 参照 -->
		<nav class="navbar navbar-default navbar-static-top navbar-inverse">
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
					<a class="navbar-brand" href="{{ url('/login') }}">ViewLog</a>
					@else
					<!-- Branding Image -->
					<a class="navbar-brand" href="{{ url('/home') }}">ViewLog</a>
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
						@if (Auth::user()->role == 0 or Auth::user()->role == 1)
						<li><a href="{{ route('register') }}">Register</a></li>
						@endif
						<li class="dropdown"><a href="#" class="dropdown-toggle"
							data-toggle="dropdown" role="button" aria-expanded="false"
							aria-haspopup="true"> {{ Auth::user()->name}}
							<span class="caret"></span>
						</a>

							<ul class="dropdown-menu">
								<li><a href="{{ route('users') }}">Users</a></li>
								<li><a href="{{ route('logout') }}"
									onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"> Logout </a>

									<form id="logout-form" action="{{ route('logout') }}"
										method="POST" style="display: none;">{{ csrf_field() }}</form>
								</li>
							</ul>
						</li>
						@endauth
					</ul>
				</div>
			</div>
		</nav>
		@yield('content')
	</div>

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('js/jquery.bootgrid.js') }}"></script>

	</body>
</html>