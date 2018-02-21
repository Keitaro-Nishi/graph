<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BotlogController
{
	public function index(Request $request)
	{
		$botlogs = Botlog::all();
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
