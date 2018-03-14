<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>
	属性登録
</title>

<!-- Styles -->
<link href="{{ asset('css/common.css') }}" rel="stylesheet">
<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/Buttons.css') }}" rel="stylesheet">

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
</head>
</html>

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