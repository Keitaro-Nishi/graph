@extends('layouts.app')

@section('content')
<table id="grid-basic"
	class="table table-condensed table-hover table-striped">

	<thead>
		<tr>
			<th data-column-id="name" data-width="30%">ユーザー</th>
			<!--  <th data-column-id="icon"  data-width="5%" data-formatter="icons" data-sortable="false"></th>-->
			<th data-column-id="classification" data-width="20%">分類</th>
			<th data-column-id="time" data-width="40%">時間</th>
		</tr>
	</thead>
	<tbody>
		@foreach($logindata as $infomation)
		<tr>
			<td>{{$infomation->name}}</td>
			 <!--  <td></td> -->
			<td>{{$infomation->classification}}</td>
			<td>{{$infomation->time}}</td>
		</tr>
		@endforeach

	</tbody>
</table>

<script>

			/*
			var tr = $("table tr");//全行を取得
			var rowCount =tr.length;
			alert(rowCount);
			*/

			$(function() {
				$("#header").load("header.html");
				$("#grid-basic").bootgrid({
					/*selection: true,
					multiSelect: true,
					rowSelect: true
					*/
					//formatters: {
				      //"icons": function($column, $row) {

				    	  		//return "<span class='glyphicon glyphicon-log-in'></span>";

								    	 /*for (var i = 0; i < rows.length; i++){
								  	         if(rows[i].classification =="ログイン"){
									         	return "<span class='glyphicon glyphicon-log-in'></span>";
								  	         }
								  	         if(rows[i].classification =="ログアウト"){
									         	return "<span class='glyphicon glyphicon-log-out'></span>";
								    	 	 }
								    	 }*/

								//}
					//}
				});
			});

</script>
@endsection
