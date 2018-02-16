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
			<th data-column-id="id" data-identifier="true" data-width="5%" data-order="desc">NO</th>
			<th data-column-id="userid" data-width="30%">ユーザーID</th>


		    <!--  @foreach($logindata as $infomation)

			@if ($infomation->classification == (string)'ログイン' )-->
		    <th data-column-id="icon1"  data-width="5%" data-formatter="icons1" data-sortable="false"></th>
		    <!--  @endif

		    @if ($infomation->classification == (string)'ログアウト')
		    <th data-column-id="icon2"  data-width="5%" data-formatter="icons2" data-sortable="false"></th>
		    @endif

		    @endforeach-->

			<th data-column-id="classification" data-width="20%">分類</th>
			<th data-column-id="time" data-width="40%">時間</th>
		</tr>
	</thead>
	<tbody>
		@foreach($logindata as $infomation)
		<tr>
			<td>{{$infomation->id}}</td>
			<td>{{$infomation->userid}}</td>
			 <td></td>
			<td>{{$infomation->classification}}</td>
			<td>{{$infomation->time}}</td>
		</tr>
		@endforeach

	</tbody>
</table>

<script>

			$(function() {
				$("#header").load("header.html");
				$("#grid-basic").bootgrid({


					formatters: {
				      "icons1": function($column, $row) {
						         return "<span class='glyphicon glyphicon-log-in'></span>";
								}
					  /*"icons2": function($column, $row) {
							     return "<span class='glyphicon glyphicon-log-out'></span>";
					        	}*/
					}



				});
			});

</script>
</body>
</html>
