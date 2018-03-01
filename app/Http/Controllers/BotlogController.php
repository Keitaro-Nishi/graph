<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Botlog;
use Illuminate\Support\Facades\Auth;

class BotlogController
{

	public function index(Request $request)
	{
		//$botlogs = Botlog::all();
		//$cityCD = Auth::user()->citycode;
		//$cityCode = Auth::user()->citycode;
		//$botlogs = Botlog::where('citycode', $cityCode)->get();
		//$botlogs = Botlog::where('citycode', $citycode)->get();

		$cityCD = Auth::user()->citycode;

		if($cityCD == "00000"){
		$botlogs = Botlog::all();
		}else{
		$botlogs = Botlog::where('citycode', $cityCD)->get();
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
