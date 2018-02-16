<!DOCTYPE html>
<html>
<head>
<meta name="description" content="ログイン情報">
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
<div id="header"></div>
<table id="list">

	<thead>
		<tr>
			<th data-column-id="id" data-identifier="true" data-width="5%" data-order="desc">NO</th>
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
			<td>{{$infomation->classification}}</td>
			<td>{{$infomation->time}}</td>
		</tr>
		@endforeach

	</tbody>
</table>
</body>
</html>
