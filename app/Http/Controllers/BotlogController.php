<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BotlogController
{
	/*public function __construct()
	{
		$this->middleware('auth');
	}
	*/

	public function index(Request $request)
	{
		$botlogs =DB::select('select * from botlog');
		return view('botlog',['botlogs'=>$botlogs]);
	}

	public function delete(Request $request)
	{
		$deleteno = $request->deleteno;
		//$deletebotlog = DB::select('select * from botlog');
		DB::delete('delete from botlog WHERE no=?',[$deleteno]);
		return redirect('/botlog');
	}

}
