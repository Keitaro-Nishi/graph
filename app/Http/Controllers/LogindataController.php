<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Logindata;
use Illuminate\Support\Facades\Auth;

class LogindataController
{
	public function index(Request $request)
	{
		$Authrole = Auth::user()->role;
		$cityCD = Auth::user()->citycode;


		if($cityCD == "00000"){
			//$logindata = Logindata::all();
			$logindata = Logindata::orderBy('id', 'DESC')->get();
		}else{
			$logindata= Logindata::where('citycode', $cityCD)->orderBy('time', 'DESC')->get();
		}
		return view('logindata',['logindata'=>$logindata]);
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
		Logindata::destroy($input["logindataids"]);

		return \Response::json(['status' => 'OK']);
	}
}