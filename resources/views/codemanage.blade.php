@extends('layouts.app')

@section('title')
コード管理
@stop

@section('content')
<div class="container">
<table id="grid-basic"
	class="table table-condensed table-hover table-striped">
	{{$name}}
	<select class="form-control" id="codesel" onChange="codeselChange()" width="200px">
				<option value="0" selected>分類</option>
	</select>
	<thead>
		<tr>
			<th data-column-id="no" data-type="numeric" data-identifier="true" data-width="4%">NO</th>
			<th data-column-id="time" data-width="10%">日時</th>
			<th data-column-id="userid" data-width="10%">ユーザーID</th>
			<th data-column-id="contents"  data-width="35%">質問内容</th>
            <th data-column-id="return"  data-width="35%">回答内容</th>
            <th data-column-id='detail'  data-width='6%' data-formatter='details' data-sortable='false'></th>
		</tr>
	</thead>
	<tbody>
		@foreach($botlogs as $botlog)
		<tr>
			<td>{{$botlog->no}}</td>
			<td>{{$botlog->time}}</td>
			<td>{{$botlog->userid}}</td>
			<td>{{$botlog->contents}}</td>
			<td>{{$botlog->return}}</td>
			<!--  <td></td>-->
		</tr>
		@endforeach
	</tbody>
</table>
</div>

<div class="container" align="center">
	<input id="btn_del" type="button" class="btn btn-default" value="選択行の削除" onclick="drow()">
</div>

<script src="{{ asset('js/codemanage.js') }}"></script>
@endsection