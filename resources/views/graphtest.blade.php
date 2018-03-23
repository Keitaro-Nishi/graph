@extends('layouts.app')

@section('title')
グラフテスト
@stop

@section('content')
<div>
<canvas id="myChart"></canvas>
</div>


<script src="{{ asset('js/botlog.js') }}"></script>
@endsection
