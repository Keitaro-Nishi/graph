<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Logimage;

class LogimageController {
	public function index(Request $request) {
		/*
		 * $cityCD = Auth::user ()->citycode;
		 * if ($cityCD = "00000") {
		 * $logimages = Logimage::select('citycode', 'no', 'time', 'userid', 'score', 'class')->get ();
		 * } else {
		 * $logimages = Logimage::select('citycode', 'no', 'time', 'userid', 'score', 'class')->where ( 'citycode', $cityCD )->get ();
		 * }
		 * return view ( 'logimage', [
		 * 'logimages' => $logimages,
		 * ] );
		 */
		$logimages = Logimage::all ()->first ();

		// バイナリデータ取得
		$fileData = $logimages->image;

		// 取得したバイナリデータをファイルに書き込んでレスポンスに返却
		$writingHogeData = '.jpg';
		file_put_contents ( $writingHogeData, $fileData );

		// 拡張子はhoge
		$headers = array (
				'Content-Type: application/jpg'
		);
		return view ( 'logimage', [
				'writingHogeData' => $writingHogeData,
				'headers' => $headers,
		] );
	}
	public function request() {
		$this->requestall = \Request::all ();
		if ($this->requestall ["param"] == "update") {
			return $this->update ();
		} elseif ($this->requestall ["param"] == "delete") {
			return $this->delete ();
		}
	}
	public function delete() {
		$input = $this->requestall;
		Logimage::destroy ( $input ["nos"] );
		return \Response::json ( [
				'status' => 'OK'
		] );
	}
}