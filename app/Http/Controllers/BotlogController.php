<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Botlog;

class BotlogController
{

	public function index(Request $request)
	{

		$cityCD = Auth::user()->citycode;
		if($cityCD = "00000"){
			$botlogs = Botlog::all();
		}else{
			$botlogs= Botlog::where('citycode', $cityCD)->get();
		}

		return view('botlog',['botlogs'=>$botlogs]);
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

	public function delete(Request $request)
	{
		$input = $this->requestall;
		$nos = $input ["nos"];
		$cityCD = Auth::user ()->citycode;
		foreach ( $nos as $no ) {
			DB::table('facility')->where('id',$no)->delete();
		}
		return \Response::json(['status' => 'OK']);

		return redirect('/botlog');
	}

}
