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
		if($cityCD == "00000"){
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
	//public function update()
	{
		$input = \Request::all();

		/*
		$request->validate([
			'citycode' => 'required|string',
			'name' => 'required|string|max:255',
			'userid' => 'required|string|max:255|unique:users',
			'organization' => 'required|string|max:255',
			'password' => 'required|string|min:6|confirmed'
		]);
		*/

		error_log("★★★★★★★★★★★★★update★★★★★★★★★★★★★★★".$input["organization"]);

		$user = new User;
		$cityCD = Auth::user()->citycode;
		//市町村コード
		if($cityCD == "00000"){
			$user->citycode= $input["citycode"];
		}else{
			$user->citycode= $cityCD;
		}
		//ユーザーＩＤ
		$user->userid= $input["userid"];
		//名前
		$user->name= $input["name"];
		//権限
		if($cityCD == "00000"){
			$user->role= (int)1;
		}else{
			$user->role= (int)2;
		}
		//所属
		$user->organization= $input["organization"];
		//パスワード
		$user->password= bcrypt($input["password"]);
		//email
		$user->email= "";
		//予備
		$user->reserve= "";

		$result = $user->save();
		error_log("★★★★★★★★★★★★★update★★★★★★★★★★★★★★★".$result);

		return redirect('/users');
	}

}
