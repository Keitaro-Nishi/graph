<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@section('title') ログイン @show</title>

<!-- Styles -->
<link href="{{ asset('css/common.css') }}" rel="stylesheet">
<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/Buttons.css') }}" rel="stylesheet">
<link href="{{ asset('css/jquery.bootgrid.css') }}" rel="stylesheet">

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/jquery.bootgrid.js') }}"></script>
<script
	src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

</head>
<body>
	<div id="app">
		<nav class="navbar navbar-default navbar-static-top">
			<div class="container">
				<div class="navbar-header"></div>
			</div>
		</nav>
		@yield('content')
	</div>
</body>
</html>
