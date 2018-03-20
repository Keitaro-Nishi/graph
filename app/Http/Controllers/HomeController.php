<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\Logindata;

class HomeController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware ( 'auth' );
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$userid = Auth::user ()->userid;
		$loginedpass = Auth::user ()->password;
		$nowpass = User::select ( 'password' )->where ( 'userid', $userid )->first ();
		$count = Logindata::where ( 'userid', $userid )->count ();
		if ($count == 1) {
			if ($nowpass == $loginedpass) {
				return Redirect ( '/usersetting' );
			}
		}
		return view ( 'home' );
	}
}
