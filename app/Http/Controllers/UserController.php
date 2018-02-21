<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController
{

	public function index(Request $request)
	{
		$users = User::all();
		return view('users',['users'=>$users]);
	}

	public function delete(Request $request)
	{

		$deleteid = $request->deletecode;
		$deleteuser = User::find($deleteid);
		$deleteuser->delete();

		return redirect('/users');
	}

}
