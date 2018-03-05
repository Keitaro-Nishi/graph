@extends('layouts.app')

@section('title')
コード管理
@stop

@section('content')
<div class="container">
<table id="grid-basic"
	class="table table-condensed table-hover table-striped">
	<select class="form-control" id="codesel" onChange="codeselChange()" width="200">
		@foreach($bunrui as $value)
			<option value={{$code->code2}} selected>{{$value->meisho}}</option>
		@endforeach
	</select>
	<thead>
		<tr>
			<th data-column-id="code12" data-identifier="true" data-visible="false">コード12</th>
			<th data-column-id="code1" data-visible="false"></th>
			<th data-column-id="code2" >コード</th>
			<th data-column-id="meisho" >名称</th>
			<th data-column-id="num"  >数値</th>
			<th data-column-id="class1" data-visible="false"></th>
			<th data-column-id="class2" data-visible="false"></th>
            <th data-column-id='detail'  data-width='6%' data-formatter='details' data-sortable='false'></th>
		</tr>
	</thead>
	<tbody>
		@foreach($codes as $code)
		<tr>
			<td>{{$code->code1}}.".".{{$code->code2}}</td>
			<td>{{$code->code1}}</td>
			<td>{{$code->code2}}</td>
			<td>{{$code->meisho}}</td>
			<td>{{$code->num}}</td>
			<td>{{$code->class1}}</td>
			<td>{{$code->class2}}</td>
		</tr>
		@endforeach
	</tbody>
</table>
</div>

<div class="container" align="center">
	<input id="btn_del" type="button" class="btn btn-default" value="選択行の削除" onclick="drow()">
	<input id="btn_ins" type="button" class="btn btn-default" value="ユーザー登録" onclick="insert()">
	<input id="btn_modal" type="button" style="display:none" data-toggle="modal"  data-target="#shosaiDialog"/>
</div>

<script src="{{ asset('js/codemanage.js') }}"></script>
@endsection