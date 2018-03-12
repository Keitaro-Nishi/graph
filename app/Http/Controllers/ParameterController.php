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
		/*
		$parameter = Parameter::where('citycode', $cityCD)->first();
		if(!$parameter){
			$parameter = new Parameter();
		}
		*/
		if($cityCD == "00000"){
			$parameters = Parameter::all();
		}else{
			$parameters = Parameter::select('citycode','usefunction','intpasscalss','intpass')->where('citycode', $cityCD)->get();
		}

		return view('parameter',['parameters'=>$parameters]);
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

		$cityCD = $input["citycode"];
		$cityname = $input["cityname"];

		$result = DB::table('parameter')->insert([
				'citycode' => $cityCD,
				'cityname' => $cityname
		] );

		return \Response::json(['status' => 'OK']);
	}

	public function update()
	{
		$input = $this->requestall;

		if($input["intpasscalss"] == "2"){
			$rules = $rules + ['intpass' => 'required|string|min:6'];
		}

		$validator = Validator::make($input,$rules);

		if($validator->fails())
		{
			return $validator->errors();
		}

		$cityCD = Auth::user()->citycode;
		$intpasscalss = $input["intpasscalss"];
		$intpass = $input["intpass"];
		if($input["citycode"] != ""){
			$cityCD = $input["citycode"];
			$cityname = $input["cityname"];
			$line_cat = $input["line_cat"];
			$cvs_ws_id1 = $input["cvs_ws_id1"];
			$cvs_ws_id2 = $input["cvs_ws_id2"];
			$cvs_ws_id3 = $input["cvs_ws_id3"];
			$cvs_ws_id4 = $input["cvs_ws_id4"];
			$cvs_ws_id5 = $input["cvs_ws_id5"];
			$usefunction = $input["usefunction"];

			DB::table('parameter')->where('citycode', $cityCD)->update([
					'cityname' => $cityname,
					'line_cat' => $line_cat,
					'cvs_ws_id1' => $cvs_ws_id1,
					'cvs_ws_id2' => $cvs_ws_id2,
					'cvs_ws_id3' => $cvs_ws_id3,
					'cvs_ws_id4' => $cvs_ws_id4,
					'cvs_ws_id5' => $cvs_ws_id5,
					'usefunction' => $usefunction,
					'intpasscalss' => $intpasscalss,
					'intpass' => $intpass
			]);
		}else{
			DB::table('parameter')->where('citycode', $cityCD)->update([
					'intpasscalss' => $intpasscalss,
					'intpass' => $intpass
			]);
		}

		return \Response::json(['status' => 'OK']);
	}
}
