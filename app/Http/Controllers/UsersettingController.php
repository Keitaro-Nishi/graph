<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersettingController extends Controller {
	public function index() {
		$userid = Auth::user ()->userid;
		$name = Auth::user ()->name;
		return view ( 'usersetting', [
				'userid' => $userid,
				'name' => $name
		] );
	}
	public function update() {
		$userid = Auth::user ()->userid;
/*
		$rules = [
				'name' => 'required|string|max:255',
				'password' => 'required|string|min:6|confirmed'
		];

		$validator = Validator::make ( $input, $rules );

		if ($validator->fails ()) {
			return $validator->errors ();
		}
*/
		$input = \Request::all ();
		$newName = $input ["name"];
		$oldpassword = $input ["oldpassword"];
		//$password = $input ["password"];
		$newpassword = bcrypt ( $input ["password"] );

		$nowpassword = User::select ( 'password', 'name' )->where ( 'userid', $userid )->first ();

		if (Hash::check ( $oldpassword, $nowpassword->password )) {
			/*
			 * if (Hash::check ( $password, $nowpassword->password )) {
			 *
			 * return \Response::json ( [
			 * 'status' => 'BACK'
			 * ] );
			 * } else {
			 */
			User::where ( 'userid', $userid )->update ( [
					'name' => $newName,
					'password' => $newpassword
			] );
			return \Response::json ( [
					'status' => 'OK'
			] );
			// }
		} else {
			return \Response::json ( [
					'status' => 'NG'
			] );
		}
	}
}