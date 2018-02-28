@extends('layouts.app')

@section('content')
<table id="grid-basic"
	class="table table-condensed table-hover table-striped">
	<thead>
		<tr>
			<th data-column-id="id" data-type="numeric" data-identifier="true">ID</th>
			<th data-column-id="meisho">名称</th>
			<th data-column-id="jusho">住所</th>
			<th data-column-id="tel">電話番号</th>
			<th data-column-id="genre1">ジャンル１</th>
			<th data-column-id="genre2">ジャンル2</th>
			<th data-column-id="lat">緯度</th>
			<th data-column-id="lng">経度</th>
			<th data-column-id="imageurl">画像URL</th>
			<th data-column-id="url">詳細URL</th>
			<th data-column-id='detail' data-formatter='details' data-sortable='false'></th>
		</tr>
	</thead>
	<tbody>
		@foreach($facilitys as $facility)
		<tr>
			<td>{{$facility->id}}</td>
			<td>{{$facility->meisho}}</td>
			<td>{{$facility->jusho}}</td>
			<td>{{$facility->tel}}</td>
			<td>{{$facility->genre1}}</td>
			<td>{{$facility->genre2}}</td>
			<td>{{$facility->lat}}</td>
			<td>{{$facility->lng}}</td>
			<td>{{$facility->imageurl}}</td>
			<td>{{$facility->url}}</td>
			<td></td>
		</tr>
		@endforeach
	</tbody>
</table>

<div class="modal" id="shosaiDialog" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content" style="width: 740px; margin-left: -20px;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="modal-label">施設登録</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" method="POST" action="{{ route('facility') }}">
					<div class="form-group">
						<label class="col-sm-3 control-label" for="dia_meisho">施設名称</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="dia_meisyo" name="meisyo" value=""  placeholder="行政公園" required autofocus>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="dia_jusho">住所</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="dia_jusho" name="jusho" value=""  placeholder="行政市行政1-1-1" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="dia_tel">電話番号</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="dia_tel" name="tel" value=""  placeholder="000-000-0000" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="dia_genre1">ジャンル1</label>
						<div class="col-sm-9">
							<select class="form-control" id="dia_genre1" name="genre1">
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="dia_genre2">ジャンル2</label>
						<div class="col-sm-9">
							<select class="form-control" id="dia_genre2" name="genre2">
							</select>
						</div>
					</div>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="description" content="施設情報">
<title>施設情報</title>
<link href="css/common.css" rel="stylesheet" />
<link href="css/bootstrap.css" rel="stylesheet" />
<link href="css/jquery.bootgrid.css" rel="stylesheet" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.js"></script>
<script src="js/jquery.bootgrid.js"></script>
</head>
<body>
<div id="loader-bg">
  <div id="loader">
    <img src="img/loading.gif" width="80" height="80" alt="Now Loading..." />
    <p>Now Loading...</p>
  </div>
</div>
<div id="wrap" style="display:none">
<div id="header"></div>
<?php
//環境変数の取得
$db_host =  getenv('DB_HOST');
$db_name =  getenv('DB_NAME');
$db_pass =  getenv('DB_PASS');
$db_user =  getenv('DB_USER');
//DB接続
$conn = "host=".$db_host." dbname=".$db_name." user=".$db_user." password=".$db_pass;
$link = pg_connect($conn);
//ジャンル
$j1value = array();
$j2value = array();
if ($link) {
	$result = pg_query("SELECT * FROM shisetsu ORDER BY genre1, genre2");
	echo "<table id='grid-basic' class='table table-condensed table-hover table-striped'>";
	echo "<thead>";
	echo "<tr><th data-column-id='id' data-type='numeric' data-identifier='true' data-width='3%'>ID</th>
               <th data-column-id='meisho' data-width='10%'>名称</th>
               <th data-column-id='jusho'  data-width='10%'>住所</th>
               <th data-column-id='tel'  data-width='7%'>電話番号</th>
               <th data-column-id='genre1'  data-width='10%'>ジャンル１</th>
               <th data-column-id='genre2'  data-width='10%'>ジャンル２</th>
               <th data-column-id='lat'  data-width='5%'>緯度</th>
               <th data-column-id='lng'  data-width='5%'>経度</th>
               <th data-column-id='iurl'  data-width='17%'>画像URL</th>
               <th data-column-id='url'  data-width='17%'>詳細URL</th>
               <th data-column-id='mod'  data-width='6%' data-formatter='mods' data-sortable='false'></th>
           </tr>";
	echo "</thead>";
	echo "<tbody>";
	while ($row = pg_fetch_row($result)) {
		echo "<tr>";
		echo "<td>";
		echo $row[0];
		echo "</td>";
		echo "<td>";
		echo $row[1];
		echo "</td>";
		echo "<td>";
		echo $row[2];
		echo "</td>";
		echo "<td>";
		echo $row[3];
		echo "</td>";
		$result2 = pg_query("SELECT meisho FROM genre WHERE gid1 = {$row[4]} AND bunrui = 1");
		$row2 = pg_fetch_row($result2);
		echo "<td>";
		echo $row2[0];
		echo "</td>";
		$result2 = pg_query("SELECT meisho FROM genre WHERE gid1 = {$row[4]} AND gid2 = {$row[5]} AND bunrui = 2");
		$row2 = pg_fetch_row($result2);
		echo "<td>";
		echo $row2[0];
		echo "</td>";
		echo "<td>";
		echo $row[7];
		echo "</td>";
		echo "<td>";
		echo $row[8];
		echo "</td>";
		echo "<td>";
		echo $row[9];
		echo "</td>";
		echo "<td>";
		echo $row[10];
		echo "</td>";
		echo "</tr>";
	}
	echo "</tbody>";
	echo "</table>";
	echo "<br>";
	//ジャンル情報検索
	$result = pg_query("SELECT * FROM genre WHERE bunrui = 1");
	while ($row = pg_fetch_row($result)) {
		$j1value = $j1value + array($row[1] => $row[4]);
	}
	foreach($j1value as $key => $value){
		$result = pg_query("SELECT * FROM genre WHERE bunrui = 2 AND gid1 = {$key}");
		$arr = array();
		while ($row = pg_fetch_row($result)) {
			$arr = $arr + array($row[2] => $row[4]);
		}
		$j2value = $j2value + array($key => $arr);
	}
}
?>
<div class="container" align="center">
	<input id="btn_del" type="button" class="btn btn-default" value="選択行の削除" onclick="drow()">
	<input id="btn_ins" type="button" class="btn btn-default" value="施設の追加" onclick="irow()">
	<input id="btn_modal" type="button" style="display:none" data-toggle="modal"  data-target="#shosaiDialog" value="モーダル表示" />
</div>
</div>
<div class="modal" id="shosaiDialog"  tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content" style="width:740px; margin-left: -20px;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="modal-label">施設登録</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_meisho">施設名称</label>
						<div class="col-sm-10">
							<input id="dia_meisho" class="form-control" maxlength="40" placeholder="行政公園">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_jusho">住所</label>
						<div class="col-sm-10">
							<input id="dia_jusho" class="form-control" maxlength="128" placeholder="行政市行政1-1-1">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_tel">電話番号</label>
						<div class="col-sm-10">
							<input id="dia_tel" class="form-control" type="tel" maxlength="14" placeholder="000-000-0000">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_j1">ジャンル１</label>
						<div class="col-sm-10">
							<select class="form-control" id="dia_j1"  onChange="j1change()">
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_j2">ジャンル２</label>
						<div class="col-sm-10">
							<select class="form-control" id="dia_j2">
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_latlng">緯度・経度</label>
						<div class="col-sm-10">
							<input id="dia_latlng" class="form-control" maxlength="33" placeholder="999.99999,999.99999">
							<input type="button" class="btn btn-default" style="display:inline;" onclick="map()" value="地図の確認" style="width: 100px;"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_iurl">画像ＵＲＬ</label>
						<div class="col-sm-10">
							<input id="dia_iurl" class="form-control" maxlength="300" placeholder="https://www.yyy.zzz.jpg">
							<input type="button" class="btn btn-default" style="display:inline;" onclick="image()" value="画像の確認" style="width: 100px;"/>
							※必ずhttpsから始まるURLを指定してください
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_url">詳細ＵＲＬ</label>
						<div class="col-sm-10">
							<input id="dia_url" class="form-control" maxlength="300" placeholder="http://www.yyy.zzz.html">
						</div>
					</div>
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="text-right" >
						<button type="submit" class="btn btn-primary">登録</button>
						<button id="dia_close" type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="container" align="center">
	<input id="btn_del" type="button" class="btn btn-default" value="選択行の削除" onclick="drow()">
	<input id="btn_ins" type="button" class="btn btn-default" value="施設登録" onclick="insert()">
	<input id="btn_modal" type="button" style="display:none" data-toggle="modal"  data-target="#shosaiDialog"/>
</div>
<script src="{{ asset('js/users.js') }}"></script>

@endsection