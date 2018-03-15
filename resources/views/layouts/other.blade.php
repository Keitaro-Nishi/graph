<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>
	@section('title')
	その他
	@show
</title>

<!-- Styles -->
<link href="{{ secure_asset('css/common.css') }}" rel="stylesheet">
<link href="{{ secure_asset('css/bootstrap.css') }}" rel="stylesheet">
<link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
<link href="{{ secure_asset('css/Buttons.css') }}" rel="stylesheet">

<!-- Scripts -->
<script src="{{ secure_asset('js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

</head>
<body>
	<div id="app">
		@yield('content')
	</div>
</body>
</html>