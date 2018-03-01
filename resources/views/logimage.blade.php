@extends('layouts.app')

@section('content')
<div id="loader-bg">
  <div id="loader">
    <img src="img/loading.gif" width="80" height="80" alt="Now Loading..." />
    <p>Now Loading...</p>
  </div>
</div>
<div id="wrap" style="display:none">

<table id="grid-basic"
	class="table table-condensed table-hover table-striped">
	<thead>
		<tr>
			<th data-column-id='time'>日時</th>
			<th data-column-id='userid'>ユーザーID</th>
			<th data-column-id='imageurl'>送信画像</th>
			<th data-column-id='imageurl'>分類</th>
			<th data-column-id='imageurl'>確信度</th>
		</tr>
	</thead>
	<tbody>
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
			<td></td>
		</tr>
		@endforeach
	</tbody>
</table>

	<div class="container" align="center">
		<input id="btn_del" type="button" class="btn btn-default" value="選択行の削除" onclick="drow()">
		<input id="btn_modal" type="button" style="display:none" data-toggle="modal"  data-target="#image_Modal" value="モーダル表示" />
	</div>
</div>
<div class="modal" id="image_Modal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content" id="dia_cont">
			<div class="modal-body" align="center">
				<p id="dia_kaku"></p>
				<img  id="dia_image"/>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
			</div>
		</div>
	</div>
</div>