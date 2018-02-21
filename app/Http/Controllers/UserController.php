<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController
{

	public function index(Request $request)
	{
		$users =DB::select('select * from users');
		return view('users',['users'=>$users]);
	}

	public function delete(Request $request)
	{
		$deleteid = $request->deletecode;
		DB::delete('delete from users WHERE userid=?',[$deleteid]);
		return redirect('/users');
	}

}
