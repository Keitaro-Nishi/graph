<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Pushlog;

class PushlogController
{

	public function index(Request $request)
	{

		$cityCD = Auth::user()->citycode;

		if($cityCD == "00000"){

			$pushlogs = Pushlog::all();

		}else{

			$pushlogs= Pushlog::where('citycode', $cityCD)->get();
		}

		return view('pushlog',compact('pushlogs'));
	}


	public function request() {
		$this->requestall = \Request::all ();
		if ($this->requestall ["param"] == "delete") {
			return $this->delete ();
		}else {
			return \Response::json(['status' => 'NG']);
		}
	}

	public function delete(){
		$input = $this->requestall;
		Pushlog::destroy($input["no"]);

		return \Response::json(['status' => 'OK']);

	}
}
