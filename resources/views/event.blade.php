@extends('layouts.app')

@section('title')
イベント情報
@stop

@section('content')
<table id="grid-basic"
	class="table table-condensed table-hover table-striped">
	<thead>
		<tr>
			   <th data-column-id='no' data-identifier='true' data-width='3%' data-visible="false"></th>
			   <th data-column-id='citycode' data-width='20%' data-visible="false"></th>
			   <th data-column-id='bunrui' data-width='5%' >分類</th>
               <th data-column-id='g1' data-width='15%' >大分類名称</th>
               <th data-column-id='g2' data-width='15%' >小分類名称</th>
               <th data-column-id='date' data-width='10%' >日付</th>
			   <th data-column-id='time' data-width='10%' >時間</th>
               <th data-column-id='gid1' data-width='5%'>分類ID1</th>
               <th data-column-id='gid2' data-width='5%'>分類ID2</th>
               <th data-column-id='mod'  data-width='7%' data-formatter='mods' data-sortable='false'></th>
		</tr>
	</thead>
	<tbody>
		@foreach($genrelists as $genrelist)
		<tr>
			<td>{{$genrelist['gid1'].".".$genrelist['gid2']}}</td>
			<td>{{$genrelist['citycode']}}</td>
			@if($genrelist['bunrui'] == 1)
			<td>大分類</td>
			@else
			<td>小分類</td>
			@endif
			<td>{{$genrelist['daibunrui']}}</td>
			<td>{{$genrelist['shoubunrui']}}</td>
			<td>{{$genrelist['date']}}</td>
			<td>{{$genrelist['time']}}</td>
			<td>{{$genrelist['gid1']}}</td>
			<td>{{$genrelist['gid2']}}</td>
		</tr>
		@endforeach
	</tbody>
</table>

<input id="_token" type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="container" align="center">
	<input id="btn_del" type="button" class="btn btn-default" value="選択行の削除" onclick="drow()">
	<input id="btn_ins" type="button" class="btn btn-default" value="ジャンルの追加" onclick="irow()">
	<input id="btn_int" type="button" class="btn btn-default" value="検索ワード追加" onclick="intent()">
	<input id="btn_int" type="button" class="btn btn-default" value="類義語追加" onclick="entity()">
	<input id="btn_modal" type="button" style="display:none" data-toggle="modal"  data-target="#shosaiDialog" value="モーダル表示" />
</div>

<div class="modal" id="shosaiDialog"  tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content" style="width:740px; margin-left: -20px;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="modal-label">ジャンル登録</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_bunrui">分類</label>
						<div class="col-sm-10">
							<select class="form-control" id="dia_bunrui"  onChange="bchange()">
								<option value="1">大分類</option>
								<option value="2">小分類</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_g1meisho">大分類名称</label>
						<div class="col-sm-10">
							<input id="dia_g1meisho" class="form-control" maxlength="50" placeholder="大分類名称">
							<select id="dia_g1" class="form-control">
							@foreach($j1values as $j1value)
							<option value="{{$j1value->gid1}}">{{$j1value->meisho}}</option>
							@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dia_tel">小分類名称</label>
						<div class="col-sm-10">
							<input id="dia_g2meisho" class="form-control" maxlength="50" placeholder="小分類名称">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="time_hour">時間</label>
						<div class="col-sm-2">
							<select class="form-control" id="time_hour" >
							<option value="1">1時</option>
							<option value="2">2時</option>
							<option value="3">3時</option>
							<option value="4">4時</option>
							<option value="5">5時</option>
							<option value="6">6時</option>
							<option value="7">7時</option>
							<option value="8">8時</option>
							<option value="9">9時</option>
							<option value="10">10時</option>
							<option value="11">11時</option>
							<option value="12">12時</option>
							<option value="13">13時</option>
							<option value="14">14時</option>
							<option value="15">15時</option>
							<option value="16">16時</option>
							<option value="17">17時</option>
							<option value="18">18時</option>
							<option value="19">19時</option>
							<option value="20">20時</option>
							<option value="21">21時</option>
							<option value="22">22時</option>
							<option value="23">23時</option>
							<option value="24">24時</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="time_minute"></label>
						<div class="col-sm-2">
							<select class="form-control" id="time_minute" >
							<option value="00">00</option>
							<option value="1">1分</option>
							<option value="2">2分</option>
							<option value="3">3分</option>
							<option value="4">4分</option>
							<option value="5">5分</option>
							<option value="6">6分</option>
							<option value="7">7分</option>
							<option value="8">8分</option>
							<option value="9">9分</option>
							<option value="10">10分</option>
							<option value="11">11分</option>
							<option value="12">12分</option>
							<option value="13">13分</option>
							<option value="14">14分</option>
							<option value="15">15分</option>
							<option value="16">16分</option>
							<option value="17">17分</option>
							<option value="18">18分</option>
							<option value="19">19分</option>
							<option value="20">20分</option>
							<option value="21">21分</option>
							<option value="22">22分</option>
							<option value="23">23分</option>
							<option value="24">24分</option>
							<option value="25">25分</option>
							<option value="26">26分</option>
							<option value="27">27分</option>
							<option value="28">28分</option>
							<option value="29">29分</option>
							<option value="30">30分</option>
							<option value="31">31分</option>
							<option value="32">32分</option>
							<option value="33">33分</option>
							<option value="34">34分</option>
							<option value="35">35分</option>
							<option value="36">36分</option>
							<option value="37">37分</option>
							<option value="38">38分</option>
							<option value="39">39分</option>
							<option value="40">40分</option>
							<option value="41">41分</option>
							<option value="42">42分</option>
							<option value="43">43分</option>
							<option value="44">44分</option>
							<option value="45">45分</option>
							<option value="46">46分</option>
							<option value="47">47分</option>
							<option value="48">48分</option>
							<option value="49">49分</option>
							<option value="50">50分</option>
							<option value="51">51分</option>
							<option value="52">52分</option>
							<option value="53">53分</option>
							<option value="54">54分</option>
							<option value="55">55分</option>
							<option value="56">56分</option>
							<option value="57">57分</option>
							<option value="58">58分</option>
							<option value="59">59分</option>
							</select>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" onclick="update()">更新</button>
				<button id="dia_close" type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
			</div>
		</div>
	</div>
</div>

<script src="{{ asset('js/event.js') }}"></script>
@endsection
