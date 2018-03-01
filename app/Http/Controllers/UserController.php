<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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

		error_log("★★★★★★★★★★★★★update★★★★★★★★★★★★★★★".$input["organization"]);
		/*
		$request->validate([
			'citycode' => 'required|string',
			'name' => 'required|string|max:255',
			'userid' => 'required|string|max:255|unique:users',
			'organization' => 'required|string|max:255',
			'password' => 'required|string|min:6|confirmed'
		]);
		*/
		$rules = [
			'citycode' => 'required|string',
			'name' => 'required|string|max:255',
			'userid' => 'required|string|max:255|unique:users',
			'organization' => 'required|string|max:255',
			'password' => 'required|string|min:6|confirmed'
		];

		$validator = Validator::make($input,$rules);

		if($validator->fails())
		{
			error_log("★★★★★★★★★★★★★validat★★★★★★★★★★★★★★★".$validator->errors());
			//return Response::json($validator->errors());
			//return Response::json(['status' => 'NG']);
			$res = json_encode(array('status' => 'NG'));
			return $res;
			//return $validator->errors();
		}

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
		error_log("★★★★★★★★★★★★★result★★★★★★★★★★★★★★★".$result);

		//return Response::json(['status' => 'OK']);
		//return response()->json(['status' => 'OK']);
		return "OK";
		error_log("★★★★★★★★★★★★★end★★★★★★★★★★★★★★★");
	}

}
