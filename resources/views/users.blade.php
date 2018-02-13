<!DOCTYPE html>
<html>
<head>
<meta name="description" content="ユーザー情報">
<title>ユーザー情報</title>
<link href="css/common.css" rel="stylesheet" />
<link href="css/bootstrap.css" rel="stylesheet" />
<link href="css/jquery.bootgrid.css" rel="stylesheet" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.bootgrid.js"></script>
</head>
<body>
@extends('layouts.app')

<table id="grid-basic"
	class="table table-condensed table-hover table-striped">
	<thead>
		<tr>
			<th data-column-id="name" data-width="10%">ユーザー名</th>
			<th data-column-id="userid" data-identifier="true" data-width="10%">ユーザーID</th>
			<th data-column-id="organization" data-width="10%">組織名</th>
			<th data-column-id="role" data-width="3%">役割</th>
		</tr>
	</thead>
	<tbody>
		@foreach($users as $user)
		<tr>
			<td>{{$user->name}}</td>
			<td>{{$user->userid}}</td>
			<td>{{$user->organization}}</td>
			<td>{{$user->role}}</td>
		</tr>
		@endforeach
	</tbody>
</table>

<div class="container" align="center">
	<input id="btn_del" type="button" class="btn btn-default" value="選択行の削除" onclick="drow()">
</div>

<script>
			var rowIds = [];

			$(function() {
				//$("#header").load("header.html");
				$("#grid-basic").bootgrid({
					selection : true,
					multiSelect : true,
					rowSelect : true,
					keepSelection : true
				}).on("selected.rs.jquery.bootgrid", function(e, rows) {
					for (var i = 0; i < rows.length; i++) {
						rowIds.push(rows[i].userid);
					}
				}).on("deselected.rs.jquery.bootgrid", function(e, rows) {
					for (var i = 0; i < rows.length; i++) {
						rowIds.some(function(v, ii) {
							if (v == rows[i].userid)
								rowIds.splice(ii, 1);
						});
					}
				});
			});

			function drow() {
				if(rowIds.length == 0){
					alert("削除する行を選択してください");
					return;
				}
				var successFlg = true;
				var myRet = confirm("選択行を削除しますか？");
				if ( myRet == true ){
					for (var i = 0; i < rowIds.length; i++){
						$.ajax({
							type: "GET",
							url: 'ajax/'+ rowIds[i],
						}).then(
							function(){
							},
							function(){
								successFlg = false;
							}
						);
					}
					if( successFlg == true){
						alert("削除しました");
						location.reload();
					}else{
						alert("削除できませんでした");
					}
				}
			}
</script>
</body>
</html>

