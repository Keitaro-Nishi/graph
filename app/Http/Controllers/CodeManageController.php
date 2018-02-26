<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Botlog;

class CodeManageController
{

	public function index(Request $request)
	{
		$botlogs = Botlog::all();
		$name = Auth::user()->citycode;
		return view('codemanage',['botlogs'=>$botlogs,'name'=>$name]);

	}

	public function delete(Request $request)
	{

		$deleteno = $request->deleteno;
		$deletebotlog = Botlog::find($deleteno);
		$deletebotlog->delete();

		return redirect('/botlog');
	}

}
