<!DOCTYPE html>
<html>
<head>
<meta name="description" content="ログイン情報">
<title>ログイン情報</title>
<link href="css/common.css" rel="stylesheet" />
<link href="css/bootstrap.css" rel="stylesheet" />
<link href="css/jquery.bootgrid.css" rel="stylesheet" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.bootgrid.js"></script>
</head>
<body>
<div id="header"></div>
<table id="grid-basic"
	class="table table-condensed table-hover table-striped">
	<thead>
		<tr>
			<th data-column-id="id" data-identifier="true" data-width="3%">NO</th>
			<th data-column-id="userid" data-width="10%">ユーザーID</th>
			<th data-column-id="last_login_at" data-width="10%">最終ログイン時間</th>
		</tr>
	</thead>
	<tbody>
		@foreach($logindata as $infomation)
		<tr>
			<td>{{$infomation->id}}</td>
			<td>{{$infomation->userid}}</td>
			<td>{{$infomation->last_login_at}}</td>
		</tr>
		@endforeach
	</tbody>
</table>

<script>
			$(function() {
				$("#header").load("header.html");
			});
</script>
</body>
</html>
