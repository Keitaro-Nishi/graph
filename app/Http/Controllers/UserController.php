<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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

	public function update(Request $request)
	{
		/*
		$deleteid = $request->deletecode;
		$deleteuser = User::find($deleteid);
		$deleteuser->delete();
		*/
		error_log("★★★★★★★★★★★★★update★★★★★★★★★★★★★★★");

		return redirect('/users');
	}

	/*
	protected function validator(array $data) {
		error_log("★★★★★★★★★★★★★validator★★★★★★★★★★★★★★★");
		return Validator::make ( $data, [

				'citycode' => 'required|string',
				'name' => 'required|string|max:255',
				'userid' => 'required|string|max:255|unique:users',
				'organization' => 'required|string|max:255',
				'password' => 'required|string|min:6|confirmed'
		] );
	}
	*/

}
