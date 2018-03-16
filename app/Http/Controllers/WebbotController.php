<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WebbotController
{
	public function index(Request $request)
	{
		$citycode = Auth::user()->citycode;
		$name = Auth::user()->name;

		return view('webbot',compact('citycode','name'));
	}
}