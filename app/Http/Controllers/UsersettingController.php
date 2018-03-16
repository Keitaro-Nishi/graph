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
		$input = \Request::all ();
		$userid = Auth::user ()->userid;
		$newName = $input ["username"];
		$Oldpassword = bcrypt ( $input ["oldpassword"] );
		$newpassword = bcrypt ( $input ["password"] );

		$nowpassword = User::select ( 'password' )->where ( 'userid', $userid );
		error_log(Auth::user()->password);
		error_log($nowpassword);
		/*
		if ($nowpassword == $oldpassword) {
			User::where ( 'userid', $userid )->update ( [
					'name' => $newName,
					'password' => $newpassword
			] );
			return \Response::json ( [
					'status' => 'OK'
			] );
		} else {
			return \Response::json ( [
					'status' => 'NG'
			] );
		}
		*/
	}
}