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

		$rules = [
				'meisho' => 'string|max:255|',
				'jusho' => 'string|max:255',
				'tel' => 'string|max:14',
				'genre1' => 'integer',
				'genre2' => 'integer',
				'genre3' => 'integer',
				'imageurl' => 'string',
				'url' => 'string',
				'geom' => 'geometry'
		];

		$validator = Validator::make($input,$rules);

		if($validator->fails())
		{
			return $validator->errors();
		}

		$facility = new Facility;
		$cityCD = Auth::user()->citycode;
/*
		//市町村コード
		$facility->citycode= $cityCD;
		//名称
		$facility->meisho= $input["meisho"];
		//住所
		$facility->jusho= $input["jusho"];
		//電話番号
		$facility->tel= $input["tel"];
		//ジャンル1
		$facility->genre1= $input["genre1"];
		//ジャンル2
		$facility->genre2= $input["genre2"];
		//ジャンル3
		$facility->genre3= "";
		//経度
		$facility->lat= $input["lat"];
		//緯度
		$facility->lng= $input["lng"];
		//画像URL
		$facility->imageurl= $input["imageurl"];
		//URL
		$facility->genre3= $input["url"];
*/
		$facility = DB::insert('insert into facility (citycode, meisho, jusho, tel, genre1, genre2, genre3, lat, lng, imageurl, url, geom) values (?,?,?,?,?,?,?,?,?,?,?,?)',[$cityCD,0,0,0,0,0,0,0,0,0,0,0]);

		//return redirect ( '/facility' );
	}

	public function delete(Request $request)
	{

		$deleteid = $request->deleteid;
		$deletefacility = Facility::find($deleteid);
		$deletefacility->delete();

		return redirect('/facility');
	}

}