<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;

class UsersettingController {
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

		$input = \Request::all ();
		$newName = $input ["name"];
		$oldpassword = $input ["oldpassword"];
		$newpassword = bcrypt ( $input ["password"] );

		$nowpassword = User::select ( 'password' )->where ( 'userid', $userid )->first();
		error_log("????????????????". $oldpassword);

		if (Hash::check($oldpassword, $nowpassword)) {
			// パスワード一致
			/*
			User::where ( 'userid', $userid )->update ( [
					'name' => $newName,
					'password' => $newpassword
			] );
			*/
			return \Response::json ( [
					'status' => 'OK'
			] );
		} else {
			return \Response::json ( [
					'status' => 'NG'
			] );
		}
	}
}