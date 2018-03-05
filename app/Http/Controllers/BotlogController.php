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

	public function delete(Request $request)
	{

		$deleteno = $request->deleteno;
		$deletebotlog = Botlog::find($deleteno);
		$deletebotlog->delete();

		return redirect('/botlog');
	}

}
