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
		error_log ( '????????????????' . $id );
		$logimages = Logimage::select ( 'image' )->where ( 'no', $id )->first ();
		// error_log ( '40????????????????' . $logimages);
		/*
		 * $response = Response::make($logimages->image,200);
		 * $response->header('Content-type','image/jpeg' );
		 * $response->header('Content-Disposition','filename=image.jpg' );
		 */

		// バイナリデータ取得
		//$fileData = $logimages->image;

		// 取得したバイナリデータをファイルに書き込んでレスポンスに返却
		//$writingHogeData = 'image.jpg';
		//file_put_contents ( $writingHogeData, $fileData );
		$headers = array ('Content-Type: image/jpg');
		//$img_data=pg_unescape_bytea($logimages->image);
		//$img_data=pg_unescape_bytea($logimages["image"]);
		$bytea = stream_get_contents($logimages->image);
		$img_data=pg_unescape_bytea($bytea);
		$html_data = htmlspecialchars($img_data);

		$response = Response::make ( $html_data, 200 ,$headers);
		//$response->header ( 'Content-type', 'image/jpg' );
		// 拡張子はjpg

		return $response;
		//return response ()->file( $writingHogeData, $headers );
	}
}
