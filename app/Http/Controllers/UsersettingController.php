<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;

class UsersettingController {

	public function index(Request $request) {
		return view('usersetting');
	}

	public function update() {
		$user->userid= $input["userid"];
		$user->password= bcrypt($input["password"]);
		$result = $user->save();
		return \Response::json ( [
				'status' => 'OK'
		] );
	}
}