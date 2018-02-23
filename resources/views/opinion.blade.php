@extends('layouts.app')

@section('content')
<div class="container">

 <h2>コレクション一覧</h2>

 <table id="grid-basic"
	class="table table-condensed table-hover table-striped">

 <tr>

 <th>NO</th>
 <th>ユーザーID</th>
 <th>日時</th>
 <th>ご意見</th>
 <th>悲しみ</th>
 <th>喜び</th>
 <th>恐れ</th>
 <th>嫌悪</th>
 <th>怒り</th>
 <th>チェック</th>
 <th>詳細</th>

 </tr>

 @foreach($opinions as $opinion)

 <tr>
 <td>{{$opinion->id}}</td>
 <td>{{$opinion->userid}}</td>
 <td>{{$opinion->time}}</td>
 <td>{{$opinion->opinion}}</td>
 <td>{{$opinion->sadness}}</td>
 <td>{{$opinion->joy}}</td>
 <td>{{$opinion->fear}}</td>
 <td>{{$opinion->disgust}}</td>
 <td>{{$opinion->anger}}</td>
 <td>{{$opinion->checked}}</td>
 <td>
 <a href="#" data-toggle="modal" data-target="#deleteModal{{$opinion->id}}"><span class="glyphicon glyphicon-remove"></span>削除</a>
 </td>
 </tr>


 <div class="modal fade" id="deleteModal{{$opinion->id}}">

 <div class="modal-dialog">

 <div class="modal-content">

 <div class="modal-header">

 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

 <h4 class="modal-title alert alert-danger">『{{$opinion->userid}}』の削除</h4>

 </div>

 <div class="modal-body">

 <p>本当に削除してもいいですか</p>

 </div>


 <div class="modal-footer">
 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
 </div>


 </div><!-- /.modal-content -->

 </div><!-- /.modal-dialog -->

 </div><!-- /.modal -->

 @endforeach

 </table>
</div>
@endsection
<script>
$(function() {
	$("#grid-basic").bootgrid({
		selection : true,
		multiSelect : true,
		rowSelect : true,
		keepSelection : true
	}).on("selected.rs.jquery.bootgrid", function(e, rows) {
		for (var i = 0; i < rows.length; i++) {
			rowIds.push(rows[i].id);
		}
	}).on("deselected.rs.jquery.bootgrid", function(e, rows) {
		for (var i = 0; i < rows.length; i++) {
			rowIds.some(function(v, ii) {
				if (v == rows[i].id)
					rowIds.splice(ii, 1);
			});
		}
	});
});








</script>