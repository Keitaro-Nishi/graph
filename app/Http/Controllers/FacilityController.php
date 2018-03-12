<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Facility;
use App\Genre;

class FacilityController {
	public function index(Request $request) {
		$cityCD = Auth::user ()->citycode;
		$genre1value = array();
		$genre2value = array();

		if ($cityCD == "00000") {

			$facilities = Facility::select()->leftJoin('genre as class', function ($join) {
				$join->on('facility.citycode', '=', 'class.citycode')->where('class.bunrui', (int)1);
				$join->on('facility.genre1', '=', 'class.gid1');
			})->leftJoin('genre as class2', function ($join){
				$join->on('facility.citycode', '=', 'class2.citycode');
				$join->on('facility.genre1', '=', 'class2.gid1');
				$join->on('facility.genre2', '=', 'class2.gid2');
			})
			->select('facility.*','class.meisho as meisho1','class2.meisho as meisho2')
			->get();

		} else {
			$facilities = Facility::where('facility.citycode', $cityCD)->orderBy('genre1', 'ASC')->leftJoin('genre as class1', function ($join){
				$join->on('facility.citycode', '=', 'class1.citycode')->where('class1.bunrui', (int)1);
				$join->on('facility.genre1', '=', 'class1.gid1');
			})->leftJoin('genre as class2', function ($join){
				$join->on('facility.citycode', '=', 'class2.citycode');
				$join->on('facility.genre1', '=', 'class2.gid1');
				$join->on('facility.genre2', '=', 'class2.gid2');
			})
			->select('facility.*','class1.meisho as meisho1','class2.meisho as meisho2')
			->get();
		}

		error_log("???????????????????42".$facilities[0]->meisho1);
		$result= DB::table('genre')->where('citycode', $cityCD)->where('bunrui', 1)/*->orderBy('gid1', 'ASC')*/;
		error_log("???????????????????42".$result[0]);
		while ($row = pg_fetch_row($result)) {
			$genre1value = $genre1value + array($row[3] => $row[6]);
		}
		foreach($genre1value as $key => $value){
			$result = DB::table('genre')->where('citycode', $cityCD)->where('bunrui', 2)->where('gid1', $key);
			$arr = array();
			while ($row = pg_fetch_row($result)) {
				$arr = $arr + array($row[4] => $row[6]);
			}
			$genre2value = $genre2value + array($key => $arr);
		}
		return view('facility',['facilities' => $facilities, 'genre1value'=>$genre1value, 'genre2value'=>$genre2value]);
	}

	public function request() {
		$this->requestall = \Request::all ();
		if ($this->requestall ["param"] == "update") {
			return $this->update ();
		} elseif ($this->requestall ["param"] == "delete") {
			return $this->delete ();
		} else {
			return \Response::json ( [
					'status' => 'NG'
			] );
		}
	}

	public function update() {
		$input = \Request::all ();
		$rules = [
				'meisho' => 'string|max:255',
				'jusho' => 'string|max:255',
				'tel' => 'string|max:14',
				'genre1' => 'integer',
				'genre2' => 'integer',
				'genre3' => 'integer',
				'imageurl' => 'string',
				'url' => 'string'
		];
		$validator = Validator::make ( $input, $rules );
		if ($validator->fails ()) {
			return $validator->errors ();
		}
		// insert
		$id = $input ["id"];
		// 市町村コード
		$citycode = Auth::user ()->citycode;
		// 名称
		$meisho = $input ["meisho"];
		// 住所
		$jusho = $input ["jusho"];
		// 電話番号
		$tel = $input ["tel"];
		// ジャンル1
		$genre1 = $input ["genre1"];
		// ジャンル2
		$genre2 = $input ["genre2"];
		// ジャンル3
		$genre3 = 0;
		// 経度
		$lat = $input ["lat"];
		// 緯度
		$lng = $input ["lng"];
		// 画像URL
		$imageurl = $input ["imageurl"];
		// URL
		$url = $input ["url"];
		if ($input ["id"] == null) {
			$result = DB::table ( 'facility' )->insertGetId ( [
					'citycode' => $citycode,
					'meisho' => $meisho,
					'jusho' => $jusho,
					'tel' => $tel,
					'genre1' => $genre1,
					'genre2' => $genre2,
					'genre3' => $genre3,
					'lat' => $lat,
					'lng' => $lng,
					'imageurl' => $imageurl,
					'url' => $url,
					'geom' => \DB::raw ( "public.ST_GeomFromText('POINT({$lat} {$lng})',4326)" )
					] );
		} else {
			$result = DB::table ( 'facility' )->where ( 'id', $id )->update ( [
					'citycode' => $citycode,
					'meisho' => $meisho,
					'jusho' => $jusho,
					'tel' => $tel,
					'genre1' => $genre1,
					'genre2' => $genre2,
					'genre3' => $genre3,
					'lat' => $lat,
					'lng' => $lng,
					'imageurl' => $imageurl,
					'url' => $url,
					'geom' => \DB::raw ( "public.ST_GeomFromText('POINT({$lat} {$lng})',4326)" )
					] );
		}
	}
	public function delete() {
		$input = $this->requestall;
		$ids = $input ["ids"];
		foreach ( $ids as $id ) {
			DB::table('facility')->where('id',$id)->delete();
		}
		return \Response::json(['status' => 'OK']);
	}
}