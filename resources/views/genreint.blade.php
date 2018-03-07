@extends('layouts.app')

@section('content')
<div class="container">
	<p>大分類</p>
	<select id="g1" class="form-control" onChange="g1change()"  style="width: 600px;">
	<option selected="selected" class="msg">大分類を選択してください。</option>
	@foreach($results as $result)
	<option value="{{$result->gid1}}">{{$result->meisho}}</option>
	@endforeach
	</select>
	<br>
	<table id='grid-basic' class='table table-sm'>
		<thead>
			<tr><th >検索ワード</th><th ></th></tr>
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
<input type="button" class="btn btn-default" onclick="getwtint()" value ="テスト" />

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
				<input id="intent" class="form-control" placeholder="検索ワード">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
				<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="update()">更新</button>
			</div>
		</div>
	</div>
</div>

<script src="{{ asset('js/genreint.js') }}"></script>
@endsection
