<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Facility;

class FacilityController
{

	public function index(Request $request)
	{
		$cityCD = Auth::user()->citycode;

		if($cityCD = "00000"){
			$facilities = Facility::all();
		}else{
			$facilities= Facility::where('citycode', $cityCD)->get();
		}
		return view('facility',['facilities'=>$facilities]);
	}

	public function update(Request $request)
	{

		$input = \Request::all();
		error_log("?????????????????".$input["meisho"]."?????????????????");

		$rules = [
				'meisho' => 'string|max:255',
				'jusho' => 'string|max:255',
				'tel' => 'string|max:14',
				'genre1' => 'integer',
				'genre2' => 'integer',
				'genre3' => 'integer',
				'imageurl' => 'string',
				'url' => 'string',
		];

		$validator = Validator::make($input,$rules);

		if($validator->fails())
		{
			return $validator->errors();
		}


		//市町村コード
		$citycode = Auth::user()->citycode;
		//名称
		$meisho = $input["meisho"];
		//住所
		$jusho = $input["jusho"];
		//電話番号
		$tel = $input["tel"];
		//ジャンル1
		$genre1 = $input["genre1"];
		//ジャンル2
		$genre2 = $input["genre2"];
		//ジャンル3
		$genre3 = "";
		//経度
		$lat = $input["lat"];
		//緯度
		$lng = $input["lng"];
		//画像URL
		$imageurl = $input["imageurl"];
		//URL
		$url = $input["url"];
		error_log("?????????????????".$meisho."?????????????????");
		$result= DB::insert('insert into facility (citycode, meisho, jusho, tel, genre1, genre2, genre3, lat, lng, imageurl, url) values (?,?,?,?,?,?,?,?,?,?,?)',
				[$citycode, $meisho, $jusho, $tel, $genre1, $genre2, $genre3, $lat, $lng, $imageurl, $url]);

		if($result == "1"){
			return \Response::json(['status' => 'OK']);
		}else{
			return \Response::json(['status' => 'NG']);
		}
	}

	public function delete(Request $request)
	{

		$deleteid = $request->deleteid;
		$deletefacility = Facility::find($deleteid);
		$deletefacility->delete();

		return redirect('/facility');
	}

}