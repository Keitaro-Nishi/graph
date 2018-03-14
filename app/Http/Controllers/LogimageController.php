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
			$logimages = Logimage::all ();
			$results = Logimage::select( 'image' )->where('no', 1);
			$img_data=pg_unescape_bytea($results);
		} else {
			$logimages = Logimage::where ( 'citycode', $cityCD )->get ();
		}
		return $img_data;
		/*
		return view ( 'logimage', [
				'logimages' => $logimages,
				'image' => $image,
		] );
		*/
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
		return \Response::json ( ['status' => 'OK'] );
	}
}