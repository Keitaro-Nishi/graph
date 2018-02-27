<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController
{

	public function index(Request $request)
	{
		$cityCD = Auth::user()->citycode;
		if($cityCD = "00000"){
			$users = User::all();
		}else{
			$users= User::where('citycode', $cityCD)->get();
		}
		return view('users',['users'=>$users]);
	}

	public function delete(Request $request)
	{

		$deleteid = $request->deletecode;
		$deleteuser = User::find($deleteid);
		$deleteuser->delete();

		return redirect('/users');
	}

	//public function update(Request $request)
	public function update()
	{
		/*
		$deleteid = $request->deletecode;
		$deleteuser = User::find($deleteid);
		$deleteuser->delete();
		*/
		$input = \Request::all();
		error_log("★★★★★★★★★★★★★update★★★★★★★★★★★★★★★".$input->name);

		return redirect('/users');
	}

}
