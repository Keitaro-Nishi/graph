<!DOCTYPE html>
<html>
<head>
<meta name="description" content="市政へのご意見">
<title>市政へのご意見</title>
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
			   <th data-column-id='no' data-type='numeric' data-identifier='true' data-width='3%'>No</th>
			   <th data-column-id='date' data-width='7%'>日時</th>
               <th data-column-id='sex'  data-width='5%'>性別</th>
               <th data-column-id='age'  data-width='5%'>年齢</th>
               <th data-column-id='sadness' data-type='numeric' data-width='9%'>悲しみ</th>
               <th data-column-id='joy' data-type='numeric' data-width='9%'>喜び</th>
               <th data-column-id='fear' data-type='numeric' data-width='9%'>恐れ</th>
               <th data-column-id='disgust' data-type='numeric' data-width='9%'>嫌悪</th>
               <th data-column-id='anger' data-type='numeric' data-width='9%'>怒り</th>
               <th data-column-id='opinion'  data-width='30%'>ご意見</th>
               <th data-column-id='detail'  data-width='5%' data-formatter='details' data-sortable='false'></th>
		</tr>
	</thead>
	<tbody>
		@foreach($opinions as $opinion)
		<tr>
			<td>{{$opinion->no}}</td>
			<td>{{$opinion->date}}</td>
			@if ($opinion->sex == '1' )
			<td>男</td>
			@elseif ($opinion->sex == '2' )
			<td>女</td>
			@else
			<td>登録なし</td>
			@endif
			<td>{{$opinion->age}}</td>
			<td>{{$opinion->sadness}}</td>
			<td>{{$opinion->joy}}</td>
			<td>{{$opinion->fear}}</td>
			<td>{{$opinion->disgust}}</td>
			<td>{{$opinion->anger}}</td>
			<td>{{$opinion->opinion}}</td>
			<td></td>

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
				$("#header").load("header.html");
				$("#grid-basic").bootgrid({
					selection : true,
					multiSelect : true,
					rowSelect : true,
					keepSelection : true,
					formatters: {
				        "details": function($column, $row) {
				        	return "<input type='button' value='詳細' onclick='detailwin("  + $row.no + ")'> ";
			             }
				    }
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
