<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;

class UsersettingController {

	public function index() {
		return view('usersetting');
	}

	public function update() {
		$oldID = Auth::user ()->userid;
		$newID= $input["userid"];
		$newpassword= bcrypt($input["password"]);
		error_log($oldID);
		User::where ( 'userid', $oldID )->update ( [
				'userid' => $newID ,
				'password' => $newpassword
		] );
		return \Response::json ( [
				'status' => 'OK'
		] );
	}
}