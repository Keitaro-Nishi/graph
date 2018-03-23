@extends('layouts.other')

@section('title')
属性登録
@stop

@section('content')
<div class="container">
	<form class="form-horizontal">
		<br><br>
		<div class="form-group">
			<label class="col-sm-3 control-label" id="label_language" for="language">言語</label>
			<div class="col-sm-3">
				<select class="form-control" id="language" onChange="languageChange()">
					<option value="01">日本語</option>
					<option value="02">English</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" id="label_sex" for="sex">性別</label>
			<div class="col-sm-3">
				<select class="form-control" id="sex">
					<option value="0"></option>
					<option value="1">男性</option>
					<option value="2">女性</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" id="label_age" for="age">年齢</label>
			<div class="col-sm-3">
				<select class="form-control" id="age">
					<option value="999"></option>
					<option value="0">0</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					<option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
					<option value="23">23</option>
					<option value="24">24</option>
					<option value="25">25</option>
					<option value="26">26</option>
					<option value="27">27</option>
					<option value="28">28</option>
					<option value="29">29</option>
					<option value="30">30</option>
					<option value="31">31</option>
					<option value="32">32</option>
					<option value="33">33</option>
					<option value="34">34</option>
					<option value="35">35</option>
					<option value="36">36</option>
					<option value="37">37</option>
					<option value="38">38</option>
					<option value="39">39</option>
					<option value="40">40</option>
					<option value="41">41</option>
					<option value="42">42</option>
					<option value="43">43</option>
					<option value="44">44</option>
					<option value="45">45</option>
					<option value="46">46</option>
					<option value="47">47</option>
					<option value="48">48</option>
					<option value="49">49</option>
					<option value="50">50</option>
					<option value="51">51</option>
					<option value="52">52</option>
					<option value="53">53</option>
					<option value="54">54</option>
					<option value="55">55</option>
					<option value="56">56</option>
					<option value="57">57</option>
					<option value="58">58</option>
					<option value="59">59</option>
					<option value="60">60</option>
					<option value="61">61</option>
					<option value="62">62</option>
					<option value="63">63</option>
					<option value="64">64</option>
					<option value="65">65</option>
					<option value="66">66</option>
					<option value="67">67</option>
					<option value="68">68</option>
					<option value="69">69</option>
					<option value="70">70</option>
					<option value="71">71</option>
					<option value="72">72</option>
					<option value="73">73</option>
					<option value="74">74</option>
					<option value="75">75</option>
					<option value="76">76</option>
					<option value="77">77</option>
					<option value="78">78</option>
					<option value="79">79</option>
					<option value="80">80</option>
					<option value="81">81</option>
					<option value="82">82</option>
					<option value="83">83</option>
					<option value="84">84</option>
					<option value="85">85</option>
					<option value="86">86</option>
					<option value="87">87</option>
					<option value="88">88</option>
					<option value="89">89</option>
					<option value="90">90</option>
					<option value="91">91</option>
					<option value="92">92</option>
					<option value="93">93</option>
					<option value="94">94</option>
					<option value="95">95</option>
					<option value="96">96</option>
					<option value="97">97</option>
					<option value="98">98</option>
					<option value="99">99</option>
					<option value="100">100</option>
					<option value="101">101</option>
					<option value="102">102</option>
					<option value="103">103</option>
					<option value="104">104</option>
					<option value="105">105</option>
					<option value="106">106</option>
					<option value="107">107</option>
					<option value="108">108</option>
					<option value="109">109</option>
					<option value="110">110</option>
					<option value="111">111</option>
					<option value="112">112</option>
					<option value="113">113</option>
					<option value="114">114</option>
					<option value="115">115</option>
					<option value="116">116</option>
					<option value="117">117</option>
					<option value="118">118</option>
					<option value="119">119</option>
					<option value="120">120</option>
				</select>
			</div>
		</div>
		@foreach($codes as $code)
		<div class="form-group">
			@foreach($code as $value)
			@if($value['code2'] == 0)
			<label class="col-sm-3 control-label" id="label_option{{$value['code1']}}" for="option{{$value['code1']}}">{{$value['meisho']}}</label>
			<div class="col-sm-3">
				<select class="form-control" id="option{{$value['code1']}}" >
					<option value="0"></option>
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


<div class="container" align="center">
	<input id="btn_del" type="button" class="btn btn-default" value="削除" onclick="del()">
	<input id="btn_update" type="button" class="btn btn-primary" value="登録" onclick="update()">
</div>
<input id="_token" type="hidden" name="_token" value="{{ csrf_token() }}">
<script src="{{ asset('js/attribute.js') }}"></script>
<script>
var userinfo = @json($userinfo);
var codes = @json($codes);
var codesEn = @json($codesEn);
init();
</script>
@endsection