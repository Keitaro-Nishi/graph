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
					<input type="text" name="date_from" id="date_from" readonly>から
					<input type="text" name="date_to" id="date_to" />まで
				</form>
				<div class="container" style="position:relative; height:400px; width:400px">
					<div class="chart">
						<canvas id="myChart1"></canvas>
					</div>
					<div class="chart">
						<canvas id="myChart2"></canvas>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<input id="_token" type="hidden" name="_token" value="{{ csrf_token() }}">
<script src="{{ asset('js/graph.js') }}"></script>
<script>
init();
</script>
@endsection