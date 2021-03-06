@extends('layouts.app')

@section('title')
類義語登録
@stop

@section('content')

<div class="container">
	<p>大分類</p>
	<select id="g1" name = "daibunrui" class="form-control"  style="width: 600px;">
	<option selected="selected" class="message">大分類を選択してください。</option>
	@foreach($daibunruis as $daibunrui)
	<option value="{{$daibunrui->gid1}}" class ="{{$daibunrui->gid1}}">{{$daibunrui->meisho}}</option>
	@endforeach
	</select>
	<br>
	<p>小分類</p>
	<select id="g2" name = "shoubunrui" class="form-control" onChange="g2change()" style="width: 600px;">
	<option selected="selected" class="message">小分類を選択してください。</option>
	@foreach($shoubunruis as $shoubunrui)
	<option value="{{$shoubunrui->gid1}}" class ="{{$shoubunrui->gid1}}">{{$shoubunrui->meisho}}</option>
	@endforeach
	</select>
	<br>
	<table id='grid-basic' class='table table-sm'>
		<thead>
			<tr><th >類義語</th><th ></th></tr>
		</table>
		<tbody>
			<tr><td></td></tr>
		</tbody>
	</table>
	<br>
	<input type="button" class="btn btn-default"  data-toggle="modal" data-target="#updateDialog" value="追加" />
	<input type="button" class="btn btn-default" onclick="back()" value="もどる" />
</div>

<input id="_token" type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="modal" id="updateDialog" tabindex="-1">
	<div class="modal-dialog">
    	<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="modal-label">追加</h4>
			</div>
			<div class="modal-body">
				<input id="synonym" class="form-control" placeholder="類義語">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
				<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="update()">更新</button>
			</div>
		</div>
	</div>
</div>

<script src="{{ asset('js/genreent.js') }}"></script>
@endsection