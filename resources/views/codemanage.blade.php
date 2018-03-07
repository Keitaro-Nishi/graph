@extends('layouts.app')

@section('title')
コード管理
@stop

@section('content')
<div class="container">
<div class="col-sm-3">
	<select class="form-control" id="codesel" onChange="codeselChange()" value="{{ old('codesel') }}">
			@foreach($bunrui as $value)
				<option value="{{$value->code2}}" selected>{{$value->meisho}}</option>
			@endforeach
	</select>
</div>
<table id="grid-basic"
	class="table table-condensed table-hover table-striped">
	<thead>
		<tr>
			<th data-column-id="code12" data-identifier="true" data-visible="false">コード12</th>
			<th data-column-id="code1" data-visible="false"></th>
			<th data-column-id="code2" >コード</th>
			<th data-column-id="meisho" data-visible="false"></th>
			<th data-column-id="num" data-visible="false"></th>
			<th data-column-id="value" >設定値</th>
			<th data-column-id="class1" data-visible="false"></th>
			<th data-column-id="class2" data-visible="false"></th>
            <th data-column-id='detail'  data-width='6%' data-formatter='details' data-sortable='false'></th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>
</div>

<div class="modal" id="shosaiDialog" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content" style="width: 740px; margin-left: -20px;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="modal-label"></h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal">
					<div class="form-group" id="dia_meisho_gp">
						<label class="col-sm-3 control-label" for="dia_meisho">設定値</label>
						<div class="col-sm-9">
							<input type="text" class="form-control"  maxlength="50" id="dia_meisho" value="">
						</div>
					</div>
					<div class="form-group" id="dia_num_gp">
						<label class="col-sm-3 control-label" for="dia_num">設定値</label>
						<div class="col-sm-9">
							<input type="number" class="form-control" id="dia_num" value="">
						</div>
					</div>
					<div class="form-group" id="dia_kbn_gp">
						<label class="col-sm-3 control-label" for="dia_kbn">使用区分</label>
						<div class="col-sm-9" id="dia_kbn">
							<input type="radio" class="form-check-input" name="kbn" checked="checked">名称
							<input type="radio" class="form-check-input" name="kbn" >数値
						</div>
					</div>
					@if (Auth::user()->role == (int)0 )
					<div class="form-group" id="dia_hkbn_gp">
						<label class="col-sm-3 control-label" for="dia_hkbn">編集区分</label>
						<div class="col-sm-9">
							<select class="form-control" id="dia_hkbn" >
								<option value="1" selected>編集不可</option>
								<option value="2" selected>削除不可</option>
								<option value="3" selected>編集可</option>
								<option value="9" selected>属性使用</option>
							</select>
						</div>
					</div>
					@endif
					<input id="_token" type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="text-right" >
						<button type="button" class="btn btn-primary" onclick="update()">登録</button>
						<button id="dia_close" type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="container" align="center">
	<input id="btn_del" type="button" class="btn btn-default" value="選択行の削除" onclick="drow()">
	<input id="btn_ins" type="button" class="btn btn-default" value="コード追加" onclick="insert()">
	<input id="btn_modal" type="button" style="display:none" data-toggle="modal"  data-target="#shosaiDialog"/>
</div>
<script src="{{ asset('js/codemanage.js') }}"></script>
<script>
var tabledata = @json($codes);
init();
</script>
@endsection