<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Genre;
use App\Facility;

class FacilityController {
	public function index(Request $request) {
		$cityCD = Auth::user ()->citycode;

		if ($cityCD = "00000") {
			$facilities = Facility::all (); /* ->orderBy('citycode', 'ASC') */

			foreach ( $facilities as $facility ) {

				$citycode = $facility->citycode;
				$meisho = $facility->meisho;
				$jusho = $facility->jusho;
				$tel = $facility->tel;
				$genreL;
				$genreM;
				$lat = $facility->lat;
				$lng = $facility->lng;
				$imageurl = $facility->imageurl;
				$url = $facility->url;

				$genre1 = $facility->genre1;
				$genre2 = $facility->genre2;

				error_log($facility->genre2);

				$bunruiL = DB::table ( 'genre' )->select ( 'meisho' )->where ( 'bunrui', 1 )->where ( 'gid1', $genre1 )->where ( 'citycode', '00001' )->first ();
				$genreL = $bunruiL;
				$bunruiM = DB::table ( 'genre' )->select ( 'meisho' )->where ( 'bunrui', 1 )->where ( 'gid1', $genre1 )->where ( 'citycode', '00001')->first ();
				$genreM = $bunruiM;

				$facilitylist = [
						'citycode' => $citycode,
						'meisho' => $meisho,
						'jusho' => $jusho,
						'tel' => $tel,
						'genreL' => $genreL,
						'genreM' => $genreM,
						'lat' => $lat,
						'lng' => $lng,
						'imageurl' => $imageurl,
						'url' => $url
				];
				array_push ( $facilitylists, $facilitylist );
			}
		} else {
			$facilities = Facility::where ( 'citycode', $cityCD )->get ();
		}
		return view ( 'facility', compact ( 'facilitylists' ) );
	}
	public function update(Request $request) {
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
			// 新規登録
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
			// 編集
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
	public function delete(Request $request) {
		$deleteid = $request->deleteid;
		$deletefacility = Facility::find ( $deleteid );
		$deletefacility->delete ();
		return redirect ( '/facility' );
	}
}