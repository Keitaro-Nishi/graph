<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;

class UsersettingController {
	public function update() {
		$oldID = Auth::user ()->usesrid;
		User::where ( 'userid', $oldID )->update ( [
				'userid' => $newID ,
				'password' => $newpassword
		] );
		return \Response::json ( [
				'status' => 'OK'
		] );
	}
}