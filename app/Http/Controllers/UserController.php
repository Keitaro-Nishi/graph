<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate¥support¥Facades¥DB;
//use App\User;

class UserController 
{
	public function index(Request $request)
	{
		$users =DB::select('select * from users');
		return view('users',['users'=>$users]);
	}

}
