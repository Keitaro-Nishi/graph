@extends('layouts.app')

@section('title')
利用状況グラフ
@stop

@section('content')
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">比較</div>
		<div class="panel-body">
			<form class="form-horizontal">
				<form action="" method="post">
					from <input type="text" name="date_from" id="date_from" readonly="readonly">
					to <input type="text" name="date_to" id="date_to" />
				</form>
			</form>
		</div>
	</div>
</div>
<input id="_token" type="hidden" name="_token"
	value="{{ csrf_token() }}">
<script type="text/javascript" src="js/graph.js"></script>
@endsection