@extends('layouts.app')

@section('title')
パラメタ設定
@stop

@section('content')
<div class="container">
	<form class="form-horizontal">
		@if (Auth::user()->role == (int)0 )
		<div class="form-group">
			<label class="col-sm-3 control-label" for="citycode">市町村コード</label>
			<div class="col-sm-3">
				<select class="form-control" id="citycode" onChange="codeselChange()">
				@foreach($parameters as $value)
					<option value="{{$value->citycode}}" selected>{{$value->citycode}}:{{$value->cityname}}</option>
				@endforeach
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="cityname">団体名</label>
			<div class="col-sm-9">
				<input type="text" class="form-control"  maxlength="30" id="cityname" value="">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="line_cat">LINEチャネルアクセスTOKEN</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="line_cat" value="">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="cvs_ws_id1">ConversationWorkSpaceID1</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="cvs_ws_id1" value="">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="cvs_ws_id2">ConversationWorkSpaceID2</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="cvs_ws_id2" value="">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="cvs_ws_id3">ConversationWorkSpaceID3</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="cvs_ws_id3" value="">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="cvs_ws_id4">ConversationWorkSpaceID4</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="cvs_ws_id4" value="">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="cvs_ws_id5">ConversationWorkSpaceID5</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="cvs_ws_id5" value="">
			</div>
		</div>
		@endif
		<div class="form-group">
			<label class="col-sm-3 control-label" for="usefunction">使用機能</label>
			<div class="col-sm-9" id="usefunction">
				@foreach($functions as $value)
					<input type="checkbox" class="form-check-input" id="dia_uf{{$value->code2}}" >
					<label class="form-check-label" for="dia_uf{{$value->code2}}">{{$value->meisho}}</label>
				@endforeach
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="intpasscalss">ユーザーパスワード初期値</label>
			<div class="col-sm-3">
				<select class="form-control" id="intpasscalss" onChange="intpasscalssChange()">
					<option value="1" selected>ユーザーID</option>
					<option value="2" selected>一括設定</option>
					<option value="3" selected>個別設定</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="intpass">初期パスワード</label>
			<div class="col-sm-6">
				<input type="password" class="form-control" id="intpass" value="">
			</div>
		</div>
		<input id="_token" type="hidden" name="_token" value="{{ csrf_token() }}">
	</form>
</div>
<div class="modal" id="shosaiDialog" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content" style="width: 740px; margin-left: -20px;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="modal-label"></h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-3 control-label" for="dia_citycode">市町村コード</label>
						<div class="col-sm-9">
							<input type="text" class="form-control"  maxlength="5" id="dia_citycode" value="" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="dia_cityname">団体名</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="dia_cityname" maxlength="30" value="" required>
						</div>
					</div>
					<div class="text-right" >
						<button type="button" class="btn btn-primary" onclick="insert()">登録</button>
						<button id="dia_close" type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="container" align="center">
	<input id="btn_up" type="button" class="btn btn-primary" value="　　　更新　　　" onclick="update()">
	@if (Auth::user()->role == (int)0 )
	<input id="btn_ins" type="button" class="btn btn-default" value="新規ユーザー作成" data-toggle="modal"  data-target="#shosaiDialog"/>
	<input id="btn_del" type="button" class="btn btn-default" value="　パラメタ削除　" onclick="del()"/>
	@endif
</div>
<script src="{{ asset('js/parameter.js') }}"></script>
<script>
var parameters = @json($parameters);
init();
</script>
@endsection