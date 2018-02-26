<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Botlog;

class CodeManageController
{

	public function index(Request $request)
	{
		$cityCD = Auth::user()->citycode;
		//$botlogs = Botlog::all();
		$botlogs = Botlog::where('citycode', '=' , $cityCD);
		return view('codemanage',['botlogs'=>$botlogs,'name'=>$cityCD]);

	}

	public function delete(Request $request)
	{

		$deleteno = $request->deleteno;
		$deletebotlog = Botlog::find($deleteno);
		$deletebotlog->delete();

		return redirect('/botlog');
	}

}
