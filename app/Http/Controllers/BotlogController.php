<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Botlog;

class BotlogController{

	public function index(Request $request){

		$cityCD = Auth::user()->citycode;
		if($cityCD = "00000"){
			$botlogs = Botlog::all();
		}else{
			$botlogs= Botlog::where('citycode', $cityCD)->get();
		}

		return view('botlog',['botlogs'=>$botlogs]);
	}

	public function request() {
		$this->requestall = \Request::all ();
		if ($this->requestall ["param"] == "update") {
			return $this->update ();
		} elseif ($this->requestall ["param"] == "delete") {
			error_log("???????????????????");
			return $this->delete ();
		}
	}

	public function delete(){
		$input = $this->requestall;
		Botlog::destroy($input["nos"]);
		return \Response::json(['status' => 'OK']);
	}
}