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

			error_log("★★★★★★");
			$opinions = Opinion::all();
			error_log(print_r($opinions,true));

		}else{

			error_log("★★★★★★");
			$opinions= Opinion::where('citycode', $cityCD)->get();
			error_log(print_r($opinions,true));
			/*
			$opinions= Opinion::where('citycode', $cityCD)->first();

			error_log("★★★★★★");
			$date = date_create($opinions->time);
			$date = date_format($date , 'Y-m-d');

			error_log("☆☆☆☆☆☆");
			error_log($date);
			*/
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
}
