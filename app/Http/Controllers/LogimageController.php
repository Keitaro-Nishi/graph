<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Logimage;

class LogimageController {
	public function index(Request $request) {
		$cityCD = Auth::user ()->citycode;
		if ($cityCD = "00000") {
			$logimages = Logimage::all ()->get ();

			foreach ( $logimages as $logimage ) {

				// バイナリデータ取得
				$fileData = $logimage->image;

				// 取得したバイナリデータをファイルに書き込んでレスポンスに返却
				$writingImageData = '.jpg';
				file_put_contents ( $writingImageData, $fileData );

				// 拡張子はhoge
				$headers = array (
						'Content-Type: application/jpg'
				);
				$imagedata = $imagedata + array($logimage, $writingImageData, $headers);
			}
		} else {
			$logimages = Logimage::select ( 'citycode', 'no', 'time', 'userid', 'score', 'class' )->where ( 'citycode', $cityCD )->get ();

			foreach ( $logimages as $logimage ) {

				// バイナリデータ取得
				$fileData = $logimage->image;

				// 取得したバイナリデータをファイルに書き込んでレスポンスに返却
				$writingImageData = '.jpg';
				file_put_contents ( $writingImageData, $fileData );

				// 拡張子はhoge
				$headers = array (
						'Content-Type: application/jpg'
				);
				$imagedata = $imagedata + array($logimage, $writingImageData, $headers);
			}
		}
		return view ( 'logimage', [
				'imagedata' => $imagedata
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