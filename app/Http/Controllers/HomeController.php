<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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
		$count = Logindata::where ( 'userid', $userid )->count ();
		error_log ( "??????????????". $count."??????????????" );
		return view ( 'home' );
	}
}
