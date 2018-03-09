<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Parameter;

class ParameterController
{

	public function index(Request $request)
	{
		$cityCD = Auth::user()->citycode;
		$parameter = Parameter::where('citycode', $cityCD)->first();
		if(!$parameter){
			$parameter = new Parameter();
		}

		return view('parameter',['parameter'=>$parameter]);
	}

	public  function request(){
		$this->requestall = \Request::all();
		if($this->requestall["param"] == "update"){
			return $this->update();
		}elseif($this->requestall["param"] == "insert"){
			return $this->insert();
		}else{
			return \Response::json(['status' => 'NG']);
		}

	}

	public function insert(){
		$input = $this->requestall;

		$rules = [ 'citycode' => 'required|string|size:5|unique:parameter'];

		$validator = Validator::make($input,$rules);

		if($validator->fails())
		{
			return $validator->errors();
		}

		error_log("★★★★★★★★★★★★★citycode★★★★★★★★★★★★★★★".$input["citycode"]);
		error_log("★★★★★★★★★★★★★cityname★★★★★★★★★★★★★★★".$input["cityname"]);

		$param = Parameter::firstOrNew(['citycode' => $input["citycode"]]);
		error_log("★★★★★★★★★★★★★save１★★★★★★★★★★★★★★★");
		$param->citycode = $input["citycode"];
		error_log("★★★★★★★★★★★★★save２★★★★★★★★★★★★★★★");
		$param->cityname = $input["cityname"];
		error_log("★★★★★★★★★★★★★save３★★★★★★★★★★★★★★★");

		/*
		$param->line_cat= "";
		$param->cvs_ws_id1= "";
		$param->cvs_ws_id2= "";
		$param->cvs_ws_id3= "";
		$param->cvs_ws_id4= "";
		$param->cvs_ws_id5= "";
		$param->intpasscalss= "";
		$param->intpass= "";
		$param->usefunction= "";
		$param->reserve= "";
		*/

		error_log("★★★★★★★★★★★★★save前★★★★★★★★★★★★★★★");

		$result = $param->save();

		error_log("★★★★★★★★★★★★★save後★★★★★★★★★★★★★★★");

		return \Response::json(['status' => 'OK']);
	}

	public function update()
	{
		$input = $this->requestall;
		$cityCD = Auth::user()->citycode;
		$id = $input["id"];
		$message = $input["message"];
		$count =  Message::where('citycode', $cityCD)->where('id', $id)->count();

		if($count == 0){
			//新規
			$result = DB::table('message')->insert([
					'citycode' => $cityCD,
					'id' => $id,
					'message' => $message
					] );
		}else{
			//変更
			DB::table('message')->where('citycode', $cityCD)->where('id', $id)->update(['message' => $message]);
		}
		return \Response::json(['status' => 'OK']);
	}
}
