@extends('layouts.app')

@section('title')
利用状況グラフ
 @stop

@section('content')
<style>
.chart {
    position: relative;
    float: left;
    margin-right: 20px;
}
.chart .count {
    position: absolute;
    border-radius: 50%;
    top: 24px;
    left: 24px;
    height: 152px;
    width: 152px;
}

.chart em,
.chart span {
    font-family: Arial;
    font-weight: bold;
    width: 100%;
    text-align: center;
}
.chart em {
    display: block;
    font-size: 50px;
    font-style: normal;
    line-height: 150px;
}
.chart .caption {
    position: absolute;
    top: 50px;
    left: 40px;
}
</style>
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">比較</div>
		<div class="panel-body">
			<form class="form-horizontal">
				<form action="" method="post">
					<input type="text" name="date_from" id="date_from" readonly="readonly">から
					<input type="text" name="date_to" id="date_to" />まで
				</form>
				<button id="open" type="button" class="btn btn-default">表示</button>
				<div class="container" style="position: relative; height: 400px; width: 400px">
					<div class="chart">
						<canvas id="myChart" width="200" height="200"></canvas>
						<div class="count">
							<em>性別比</em>
						</div>
					</div>
					<div class="chart" id="chart2">
						<canvas id="myChart2" width="200" height="200"></canvas>
						<div class="count">
							<em>年齢比</em>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<input id="_token" type="hidden" name="_token"
	value="{{ csrf_token() }}">
<script type="text/javascript" src="js/graph.js"></script>
<script>
init();
</script>
@endsection
