<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Code;
use App\Message;

class MessageManageController
{

	public function index(Request $request)
	{
		$cityCD = Auth::user()->citycode;
		$messages= Message::where('citycode', $cityCD)->orderBy('id', 'ASC')->get();
		$codes= Code::where('citycode', '00000')->where('code1', (int)11)->orderBy('code2', 'ASC')->get();

		return view('messagemanage',['messages'=>$messages,'codes'=>$codes]);
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
