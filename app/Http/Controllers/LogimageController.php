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
			$logimages = Logimage::select ( 'citycode', 'no', 'time', 'userid', 'score', 'class' )->get ();
		} else {
			$logimages = Logimage::select ( 'citycode', 'no', 'time', 'userid', 'score', 'class' )->where ( 'citycode', $cityCD )->get ();
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
		//error_log ( '40????????????????' . $logimages);
		$response = Response::make(pg_unescape_bytea ( $logimages->image ));
		$response->header('Content-type','image/jpeg' );
		$response->header('Content-Disposition','filename=image.jpg' );
		//header ( 'Content-type: image/jpeg' );
		//header ( "Content-Disposition: inline; filename=image.jpg" );
		//$img_data = pg_unescape_bytea ( $logimages->image );
		//echo $img_data;
		return $response;
	}
}