<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Opinion;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class OpinionController
{
	public function index(Request $request)
	{


		$Authrole = Auth::user()->role;
		$cityCD = Auth::user()->citycode;
		if($cityCD = "00000"){
			$opinions = Opinion::all();
		}else{
			$opinions= Opinion::where('citycode', $cityCD)->get();
		}
		return view('opinion',['opinions'=>$opinions]);

	}

	public  function request(){
		$this->requestall = \Request::all();
		if($this->requestall["param"] == "delete"){
			return $this->delete();
		}else{
			return \Response::json(['status' => 'NG']);
		}
	}

	public function delete()
	{
		$input = $this->requestall;
		Opinion::destroy($input["opinionids"]);

		return \Response::json(['status' => 'OK']);
	}


		//return redirect('/opinion');

}
