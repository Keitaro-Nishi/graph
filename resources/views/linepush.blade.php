@extends('layouts.app')

@section('title')
LINEプッシュ通知送信
@stop

@section('content')
<div class="container">
	<div class="panel panel-default">
	<div class="panel-heading">対象情報</div>
	<div class="panel-body">
	<form class="form-horizontal">
	<div class="form-group">
		<label class="col-sm-2 control-label" for="taisho">送信対象者数</label>
		<div class="col-sm-2">
			<input class="form-control" id="taisho" value="{{$hitcount}}" readonly>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label" for="userinfo">属性登録有無</label>
		<div class="col-sm-2">
			<select class="form-control" id="userinfo" onChange="userinfoChange()">
				<option value="0" selected>すべて</option>
				<option value="1">登録あり</option>
				<option value="2">登録なし</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label" for="age_kara">年齢</label>
		<div class="col-sm-2">
			<select class="form-control" id="age_kara" onChange="agekChange()">
				<option value="999" selected>すべて</option>
				<option value="0">0歳</option>
				<option value="1">1歳</option>
				<option value="2">2歳</option>
				<option value="3">3歳</option>
				<option value="4">4歳</option>
				<option value="5">5歳</option>
				<option value="6">6歳</option>
				<option value="7">7歳</option>
				<option value="8">8歳</option>
				<option value="9">9歳</option>
				<option value="10">10歳</option>
				<option value="11">11歳</option>
				<option value="12">12歳</option>
				<option value="13">13歳</option>
				<option value="14">14歳</option>
				<option value="15">15歳</option>
				<option value="16">16歳</option>
				<option value="17">17歳</option>
				<option value="18">18歳</option>
				<option value="19">19歳</option>
				<option value="20">20歳</option>
				<option value="21">21歳</option>
				<option value="22">22歳</option>
				<option value="23">23歳</option>
				<option value="24">24歳</option>
				<option value="25">25歳</option>
				<option value="26">26歳</option>
				<option value="27">27歳</option>
				<option value="28">28歳</option>
				<option value="29">29歳</option>
				<option value="30">30歳</option>
				<option value="31">31歳</option>
				<option value="32">32歳</option>
				<option value="33">33歳</option>
				<option value="34">34歳</option>
				<option value="35">35歳</option>
				<option value="36">36歳</option>
				<option value="37">37歳</option>
				<option value="38">38歳</option>
				<option value="39">39歳</option>
				<option value="40">40歳</option>
				<option value="41">41歳</option>
				<option value="42">42歳</option>
				<option value="43">43歳</option>
				<option value="44">44歳</option>
				<option value="45">45歳</option>
				<option value="46">46歳</option>
				<option value="47">47歳</option>
				<option value="48">48歳</option>
				<option value="49">49歳</option>
				<option value="50">50歳</option>
				<option value="51">51歳</option>
				<option value="52">52歳</option>
				<option value="53">53歳</option>
				<option value="54">54歳</option>
				<option value="55">55歳</option>
				<option value="56">56歳</option>
				<option value="57">57歳</option>
				<option value="58">58歳</option>
				<option value="59">59歳</option>
				<option value="60">60歳</option>
				<option value="61">61歳</option>
				<option value="62">62歳</option>
				<option value="63">63歳</option>
				<option value="64">64歳</option>
				<option value="65">65歳</option>
				<option value="66">66歳</option>
				<option value="67">67歳</option>
				<option value="68">68歳</option>
				<option value="69">69歳</option>
				<option value="70">70歳</option>
				<option value="71">71歳</option>
				<option value="72">72歳</option>
				<option value="73">73歳</option>
				<option value="74">74歳</option>
				<option value="75">75歳</option>
				<option value="76">76歳</option>
				<option value="77">77歳</option>
				<option value="78">78歳</option>
				<option value="79">79歳</option>
				<option value="80">80歳</option>
				<option value="81">81歳</option>
				<option value="82">82歳</option>
				<option value="83">83歳</option>
				<option value="84">84歳</option>
				<option value="85">85歳</option>
				<option value="86">86歳</option>
				<option value="87">87歳</option>
				<option value="88">88歳</option>
				<option value="89">89歳</option>
				<option value="90">90歳</option>
				<option value="91">91歳</option>
				<option value="92">92歳</option>
				<option value="93">93歳</option>
				<option value="94">94歳</option>
				<option value="95">95歳</option>
				<option value="96">96歳</option>
				<option value="97">97歳</option>
				<option value="98">98歳</option>
				<option value="99">99歳</option>
				<option value="100">100歳</option>
				<option value="101">101歳</option>
				<option value="102">102歳</option>
				<option value="103">103歳</option>
				<option value="104">104歳</option>
				<option value="105">105歳</option>
				<option value="106">106歳</option>
				<option value="107">107歳</option>
				<option value="108">108歳</option>
				<option value="109">109歳</option>
				<option value="110">110歳</option>
				<option value="111">111歳</option>
				<option value="112">112歳</option>
				<option value="113">113歳</option>
				<option value="114">114歳</option>
				<option value="115">115歳</option>
				<option value="116">116歳</option>
				<option value="117">117歳</option>
				<option value="118">118歳</option>
				<option value="119">119歳</option>
				<option value="120">120歳</option>
			</select>
		</div>
		<label class="col-sm-1 control-label" id="age_kigo" for="age_made"style="display:none">から</label>
		<div class="col-sm-2">
			<select class="form-control" id="age_made" style="display:none" onChange="agemChange()">
				<option value="999" selected>すべて</option>
				<option value="0">0歳</option>
				<option value="1">1歳</option>
				<option value="2">2歳</option>
				<option value="3">3歳</option>
				<option value="4">4歳</option>
				<option value="5">5歳</option>
				<option value="6">6歳</option>
				<option value="7">7歳</option>
				<option value="8">8歳</option>
				<option value="9">9歳</option>
				<option value="10">10歳</option>
				<option value="11">11歳</option>
				<option value="12">12歳</option>
				<option value="13">13歳</option>
				<option value="14">14歳</option>
				<option value="15">15歳</option>
				<option value="16">16歳</option>
				<option value="17">17歳</option>
				<option value="18">18歳</option>
				<option value="19">19歳</option>
				<option value="20">20歳</option>
				<option value="21">21歳</option>
				<option value="22">22歳</option>
				<option value="23">23歳</option>
				<option value="24">24歳</option>
				<option value="25">25歳</option>
				<option value="26">26歳</option>
				<option value="27">27歳</option>
				<option value="28">28歳</option>
				<option value="29">29歳</option>
				<option value="30">30歳</option>
				<option value="31">31歳</option>
				<option value="32">32歳</option>
				<option value="33">33歳</option>
				<option value="34">34歳</option>
				<option value="35">35歳</option>
				<option value="36">36歳</option>
				<option value="37">37歳</option>
				<option value="38">38歳</option>
				<option value="39">39歳</option>
				<option value="40">40歳</option>
				<option value="41">41歳</option>
				<option value="42">42歳</option>
				<option value="43">43歳</option>
				<option value="44">44歳</option>
				<option value="45">45歳</option>
				<option value="46">46歳</option>
				<option value="47">47歳</option>
				<option value="48">48歳</option>
				<option value="49">49歳</option>
				<option value="50">50歳</option>
				<option value="51">51歳</option>
				<option value="52">52歳</option>
				<option value="53">53歳</option>
				<option value="54">54歳</option>
				<option value="55">55歳</option>
				<option value="56">56歳</option>
				<option value="57">57歳</option>
				<option value="58">58歳</option>
				<option value="59">59歳</option>
				<option value="60">60歳</option>
				<option value="61">61歳</option>
				<option value="62">62歳</option>
				<option value="63">63歳</option>
				<option value="64">64歳</option>
				<option value="65">65歳</option>
				<option value="66">66歳</option>
				<option value="67">67歳</option>
				<option value="68">68歳</option>
				<option value="69">69歳</option>
				<option value="70">70歳</option>
				<option value="71">71歳</option>
				<option value="72">72歳</option>
				<option value="73">73歳</option>
				<option value="74">74歳</option>
				<option value="75">75歳</option>
				<option value="76">76歳</option>
				<option value="77">77歳</option>
				<option value="78">78歳</option>
				<option value="79">79歳</option>
				<option value="80">80歳</option>
				<option value="81">81歳</option>
				<option value="82">82歳</option>
				<option value="83">83歳</option>
				<option value="84">84歳</option>
				<option value="85">85歳</option>
				<option value="86">86歳</option>
				<option value="87">87歳</option>
				<option value="88">88歳</option>
				<option value="89">89歳</option>
				<option value="90">90歳</option>
				<option value="91">91歳</option>
				<option value="92">92歳</option>
				<option value="93">93歳</option>
				<option value="94">94歳</option>
				<option value="95">95歳</option>
				<option value="96">96歳</option>
				<option value="97">97歳</option>
				<option value="98">98歳</option>
				<option value="99">99歳</option>
				<option value="100">100歳</option>
				<option value="101">101歳</option>
				<option value="102">102歳</option>
				<option value="103">103歳</option>
				<option value="104">104歳</option>
				<option value="105">105歳</option>
				<option value="106">106歳</option>
				<option value="107">107歳</option>
				<option value="108">108歳</option>
				<option value="109">109歳</option>
				<option value="110">110歳</option>
				<option value="111">111歳</option>
				<option value="112">112歳</option>
				<option value="113">113歳</option>
				<option value="114">114歳</option>
				<option value="115">115歳</option>
				<option value="116">116歳</option>
				<option value="117">117歳</option>
				<option value="118">118歳</option>
				<option value="119">119歳</option>
				<option value="120">120歳</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label" for="sex">性別</label>
		<div class="col-sm-2">
			<select class="form-control" id="sex" onChange="sexChange()">
				<option value="0" selected>すべて</option>
				<option value="1">男性</option>
				<option value="2">女性</option>
			</select>
		</div>
	</div>
	@foreach($codes as $code)
	<div class="form-group">
		@foreach($code as $value)
		@if($value['code2'] == 0)
		<label class="col-sm-2 control-label" id="optionlabel{{$value['code1']}}" for="option{{$value['code1']}}">{{$value['meisho']}}</label>
		<div class="col-sm-4">
			<select class="form-control" id="option{{$value['code1']}}" onChange="optionChange()">
				<option value="0" selected>すべて</option>
		@else
				<option value="{{$value['code2']}}">{{$value['meisho']}}</option>
		@endif
		@endforeach
			</select>
		</div>
	</div>
	@endforeach
	</form>
	</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">送信情報</div>
		<div class="panel-body">
			<form class="form-horizontal">
				<div class="form-group">
					<label class="col-sm-2 control-label" for="sendmess">送信内容</label>
					<div class="col-sm-10">
						<textarea class="form-control" id="sendmess" rows='10'></textarea>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="container" align="center">
	<input id="btn_del" type="button" class="btn btn-default" value="送信" onclick="send()">
</div>
<input id="_token" type="hidden" name="_token" value="{{ csrf_token() }}">
<script type="text/javascript" src="js/linepush.js"></script>
@endsection