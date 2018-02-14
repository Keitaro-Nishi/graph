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
<span  class="glyphicon glyphicon-log-in"></span>
<table id="grid-basic"
	class="table table-condensed table-hover table-striped">
	<thead>
		<tr>
			<th data-column-id="id" data-identifier="true" data-width="10%" data-order="desc">NO</th>
			<th data-column-id="userid" data-width="30%">ユーザーID</th>
			<th data-column-id="classification" data-width="20%">分類</th>
			<th data-column-id="time" data-width="40%">時間</th>
		</tr>
	</thead>
	<tbody>
		@foreach($logindata as $infomation)
		<tr>
			<td>{{$infomation->id}}</td>
			<td>{{$infomation->userid}}</td>
			<td><span  class="glyphicon glyphicon-log-in"></span></td> <!--  ログ参照 {{$infomation->classification}}-->
			<td>{{$infomation->time}}</td>
		</tr>
		@endforeach
	</tbody>
</table>

<script>

			$(function() {
				$("#header").load("header.html");
				$("#grid-basic").bootgrid({

				});
			});

</script>
</body>
</html>
