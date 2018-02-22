@extends('layouts.app')

@section('content')
<table id="grid-basic"
	class="table table-condensed table-hover table-striped">
	<thead>
		<tr>
			<th data-column-id="no" data-type="numeric" data-identifier="true" data-width="4%">NO</th>
			<th data-column-id="time" data-width="10%">日時</th>
			<th data-column-id="userid" data-width="10%">ユーザーID</th>
			<th data-column-id="contents"  data-width="35%">質問内容</th>
            <th data-column-id="return"  data-width="35%">回答内容</th>
            <th data-column-id='detail'  data-width='6%' data-formatter='details' data-sortable='false'></th>
		</tr>
	</thead>
	<tbody>
		@foreach($botlogs as $botlog)
		<tr>
			<td>{{$botlog->no}}</td>
			<td>{{$botlog->time}}</td>
			<td>{{$botlog->userid}}</td>
			<td>{{$botlog->contents}}</td>
			<td>{{$botlog->return}}</td>
			<!--  <td></td>-->
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
					/*formatters: {
				        "details": function($column, $row) {
				        	return "<input type='button' value='詳細' onclick='detailwin("  + $row.no + ")'> ";
			             }
				    }*/
				}).on("selected.rs.jquery.bootgrid", function(e, rows) {
					for (var i = 0; i < rows.length; i++) {
						rowIds.push(rows[i].no);
					}
				}).on("deselected.rs.jquery.bootgrid", function(e, rows) {
					for (var i = 0; i < rows.length; i++) {
						rowIds.some(function(v, ii) {
							if (v == rows[i].no)
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
<!--
		<div class="container" align="center">
			<input id="btn_del" type="button" class="btn btn-default" value="選択行の削除" onclick="drow()">
			<input id="btn_modal" type="button" style="display:none" data-toggle="modal"  data-target="#shosaiDialog" value="モーダル表示" />
		</div>

		<div class="modal" id="shosaiDialog"  tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content" style="width:740px; margin-left: -20px;">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="modal-label">詳細</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal">
							<div class="form-group">
								<label class="col-sm-2 control-label" for="dia_date">No</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="dia_no" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="dia_date">日時</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="dia_date" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="dia_user">ユーザーＩＤ</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="dia_user" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="dia_que">質問内容</label>
								<div class="col-sm-10">
									<textarea class="form-control" id="dia_que" rows='10' readonly></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="dia_ans">回答内容</label>
								<div class="col-sm-10">
									<textarea class="form-control" id="dia_ans" rows='10' readonly></textarea>
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button id="sback" type="button" class="btn btn-default" onclick="shosai_back()">＜＜前へ</button>
						<button id="snext" type="button" class="btn btn-default" onclick="shosai_next()">次へ＞＞</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
					</div>
				</div>
			</div>
		</div>

<script>
var rowIds = [];
var dbvalue = [];
var shosai_idx = 0;
$(function() {
	dbvalue = ?php echo json_encode($dbvalue); ?>;
	var h = $(window).height();
	$('#wrap').css('display','none');
	$('#loader-bg ,#loader').height(h).css('display','block');
	$("#header").load("header.html");
	$("#grid-basic").bootgrid({
		selection: true,
		multiSelect: true,
	    keepSelection: true,
	    formatters: {
	        "details": function($column, $row) {
	        	return "<input type='button' class='btn btn-default' value='詳細' onclick='detailwin("  + $row.no + ")' > ";
             }
	    }
	}).on("selected.rs.jquery.bootgrid", function(e, rows)
	{
	    for (var i = 0; i < rows.length; i++)
	    {
	        rowIds.push(rows[i].no);
	    }
	    //alert("Select: " + rowIds.join(","));
	}).on("deselected.rs.jquery.bootgrid", function(e, rows)
	{
	    for (var i = 0; i < rows.length; i++)
	    {
	    	rowIds.some(function(v, ii){
	    	    if (v==rows[i].no) rowIds.splice(ii,1);
	    	});
	        //rowIds.push(rows[i].no);
	    }
	    //alert("Deselect: " + rowIds.join(","));
	});
});
$(window).load(function () { //全ての読み込みが完了したら実行
	  $('#loader-bg').delay(900).fadeOut(800);
	  $('#loader').delay(600).fadeOut(300);
	  $('#wrap').css('display', 'block');
});
function drow() {
	if(rowIds.length == 0){
		alert("削除する行を選択してください");
		return;
	}
	var myRet = confirm("選択行を削除しますか？");
	if ( myRet == true ){
		$.ajax({
			type: "POST",
			url: "botlogdel.php",
			data:{
				"no" : rowIds
			}
		}).done(function (response) {
			result = JSON.parse(response);
			if(result == "OK"){
				alert("削除しました");
				location.reload();
			}else{
				alert("削除できませんでした");
			}
	    }).fail(function () {
	        alert("削除できませんでした");
	    });
	}
}
function detailwin(value){
	document.getElementById("btn_modal").click();
	for (var i = 0; i < dbvalue.length; i++){
		if(dbvalue[i][0] == value){
			shosai_idx = i;
			modal_mod(i);
		}
	}
}
function shosai_back(){
	shosai_idx = shosai_idx - 1;
	modal_mod(shosai_idx);
}
function shosai_next(){
	shosai_idx = shosai_idx + 1;
	modal_mod(shosai_idx);
}
function modal_mod(index){
	document.getElementById('dia_no').value  = dbvalue[index][0];
	var idate = dbvalue[index][1].substr(0,4) + "/" + dbvalue[index][1].substr(4,2) + "/" + dbvalue[index][1].substr(6,2) + " " + dbvalue[index][1].substr(8,2) + ":" + dbvalue[index][1].substr(10,2);
	document.getElementById('dia_date').value = idate;
	document.getElementById('dia_user').value  = dbvalue[index][2];
	document.getElementById('dia_que').innerHTML  = dbvalue[index][3];
	document.getElementById('dia_ans').innerHTML  = dbvalue[index][4];
	if(index == 0){
		document.getElementById("sback").disabled = "true";
	}else{
		document.getElementById("sback").disabled = "";
	}
	if(index == dbvalue.length - 1){
		document.getElementById("snext").disabled = "true";
	}else{
		document.getElementById("snext").disabled = "";
	}
}
</script>
-->
@endsection