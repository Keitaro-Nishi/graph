<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Parameter;

class ParameterController
{

	public function index(Request $request)
	{
		$cityCD = Auth::user()->citycode;
		$parameter = Parameter::where('citycode', $cityCD)->first();
		if($parameter){
			$parameter = new Parameter();
		}

		return view('parameter',['parameter'=>$parameter]);
	}

	public  function request(){
		$this->requestall = \Request::all();
		if($this->requestall["param"] == "update"){
			return $this->update();
		}else{
			return \Response::json(['status' => 'NG']);
		}

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
