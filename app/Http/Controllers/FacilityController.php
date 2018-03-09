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
		if ($cityCD == "00000") {

			$facilities = Facility::all ();
			/*
			$facilities = Facility::select()->leftJoin('genre', function ($join) {
				$join->on('facility.citycode', '=', 'code.citycode');
				$join->on('facility.genre1', '=', 'genre.gid1')->where('genre.bunrui', 1);
			})
			->get();
			*/
		} else {
			/*
			$facilities = Facility::select()->where('facility.citycode', $cityCD)->leftJoin('genre', function ($join) {
				$join->on('facility.citycode', '=', 'genre.citycode');
				$join->on('facility.genre1', '=', 'genre.gid1')->where('genre.bunrui', 1);
				//->select(DB::raw('meisho as larmeisho, genre'))
				//$join->on('facility.genre2', '=', 'genre.gid2')->where('genre.bunrui', 2);
			})
			->get();*/
			$facilities = Facility::where('facility.citycode', $cityCD)->leftJoin('genre as aaa', function ($join) {
				//$join->on('facility.citycode', '=', 'genre1.citycode');
				//$join->on('facility.genre1', '=', 'aaa.gid1')->where('aaa.bunrui', (int)1)->where('facility.citycode', 'aaa.citycode');
				$join->on('facility.genre1', '=', 'aaa.gid1');
				//->select(DB::raw('meisho as larmeisho, genre'))
				//$join->on('facility.genre2', '=', 'genre.gid2')->where('genre.bunrui', 2);
			})
			->select('facility.*','aaa.meisho as meisho1')
			->get();

		}
		error_log("???????????????????".$facilities[0]->meisho1);
		return view('facility',['facilities' => $facilities]);
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
