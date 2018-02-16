<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ログイン情報</title>
<link type="text/css" media="screen" href="css/jquery-ui.css" rel="stylesheet" />
    <link type="text/css" media="screen" href="css/ui.jqgrid.css" rel="stylesheet" />
    <script type="text/javascript" src="js/jquery-1.11.0.min.js" ></script>
    <script type="text/javascript" src="js/jquery-ui.min.js" ></script>
    <script type="text/javascript" src="js/jquery.jqGrid.min.js" ></script>
    <script type="text/javascript" src="js/grid.locale-ja.js" ></script>

    <script type="text/javascript">
    jQuery(document).ready(function()
    {

        jQuery("#list").jqGrid({
            multiselect: true
        });
    });
    </script>

</head>
<body>
<table id="list">

	<thead>
		<tr>
			<th>NO</th>
			<th>ユーザーID</th>
			<th>分類</th>
			<th>時間</th>
		</tr>
	</thead>
	<tbody>
		@foreach($logindata as $infomation)
		<tr>
			<td>{{$infomation->id}}</td>
			<td>{{$infomation->userid}}</td>
			<td>{{$infomation->classification}}</td>
			<td>{{$infomation->time}}</td>
		</tr>
		@endforeach

	</tbody>
</table>
</body>
</html>
