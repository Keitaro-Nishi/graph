<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Logindata;

class LogindataController
{
	public function index(Request $request)
	{

		$logindata = Logindata::all();
		return view('logindata',['logindata'=>$logindata]);

	}

}