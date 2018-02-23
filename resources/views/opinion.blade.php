@extends('layouts.app')

@section('content')
<div class="container">

 <h2>コレクション一覧</h2>

 <table class="table table-striped">

 <tr>

 <th>ID</th>

 <th>Code</th>

 <th>説明</th>

 <th>処理</th>

 </tr>

 @foreach($opinions as $opinion)

 <tr>

 <td>{{$opinion->id}}</td>

 <td>{{$opinion->userid}}</td>

 <td>{{$opinion->time}}</td>

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

 {!! Form::open(['url'=>'opinions/delete']) !!}

 {!! Form::hidden('id',$opinion->id) !!}

 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

 <input type="submit" class="btn btn-danger" value="削除">

 {!! Form::close() !!}

 </div>

 </div><!-- /.modal-content -->

 </div><!-- /.modal-dialog -->

 </div><!-- /.modal -->

 @endforeach

 </table>



</div>

@endsection

