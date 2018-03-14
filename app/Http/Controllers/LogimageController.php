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
			$results = Logimage::select(no, image);
			foreach($results as $result){
				$img_data=pg_unescape_bytea($result->image);
				$image = array($image, $img_data);
				error_log ( print_r($image, true));
			}
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
		}
	}
	public function delete() {
		$input = $this->requestall;
		Logimage::destroy ( $input ["nos"] );
		return \Response::json ( ['status' => 'OK'] );
	}
}