<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Http\Response;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use App\Logimage;

class LogimageController {
	public function index(Request $request) {
		$cityCD = Auth::user ()->citycode;
		if ($cityCD = "00000") {
			$logimages = Logimage::all ();
		} else {
			$logimages = Logimage::where ( 'citycode', $cityCD )->get ();
		}
		return view ( 'logimage', [
				'logimages' => $logimages
		] );

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

	public function delete() {
		$input = $this->requestall;
		Logimage::destroy ( $input ["nos"] );
		return \Response::json ( [
				'status' => 'OK'
		] );
	}
	public function links($id) {
		$logimages = Logimage::select ( 'image' )->where ( 'no', $id )->first ();

		// バイナリデータ取得
		$fileData = $logimages->image;

		// 取得したバイナリデータをファイルに書き込んでレスポンスに返却
		$imegeData = 'image'.$id.'.jpg';
		file_put_contents ( $imegeData, $fileData );
		$headers = array ('Content-Type: image/jpg');

		return response()->file( $imegeData, $headers );
	}
}
