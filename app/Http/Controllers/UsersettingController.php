<?php

namespace App\Http\Controllers;

use App\User;
use App\Logindata;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersettingController {
	public function index(Request $request) {
		$userid = Auth::user ()->userid;
		$name = Auth::user ()->name;
		return view ( 'usersetting', [
				'userid' => $userid,
				'name' => $name,
				'count' => $count,
		] );
	}
	public function update() {
		$userid = Auth::user ()->userid;
		$input = \Request::all ();

		$rules = [
				'name' => 'required|string|max:255',
				'password' => 'required|string|min:6|confirmed'
		];

		$validator = Validator::make ( $input, $rules );

		if ($validator->fails ()) {
			return $validator->errors ();
		}

		$newName = $input ["name"];
		$oldpassword = $input ["oldpassword"];
		$password = $input ["password"];
		$newpassword = bcrypt ( $input ["password"] );

		$nowpassword = User::select ( 'password', 'name' )->where ( 'userid', $userid )->first ();

		if (Hash::check ( $oldpassword, $nowpassword->password )) {

			if (Hash::check ( $password, $nowpassword->password )) {
				return \Response::json ( [
						'status' => 'BACK'
				] );
			} else {
				User::where ( 'userid', $userid )->update ( [
						'name' => $newName,
						'password' => $newpassword
				] );
				return \Response::json ( [
						'status' => 'OK'
				] );
				$count = Logindata::where ( 'userid', $userid )->count ();
				if ($count == 1){
					Auth::logout();
				}
			}
		} else {
			return \Response::json ( [
					'status' => 'NG'
			] );
		}
	}
}