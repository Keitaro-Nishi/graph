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
		$botlogs = Botlog::where('citycode', $citycode)->get();
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
