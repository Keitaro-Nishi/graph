<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\Logindata;
use App\Parameter;
use App\User;

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
		$cityCD = Auth::user ()->citycode;
		$parameter = Parameter::where ( 'citycode', $cityCD )->first ();
		$intpasscalss = $parameter->intpasscalss;
		error_log("????????????". $intpasscalss. "????????????");
		$count = Logindata::where ( 'userid', $userid )->count ();
		if ($count == 1) {
			if ($intpasscalss == 1 or $intpasscalss == 2) {
				return Redirect ( '/usersetting' );
			}
		}
		return view ( 'home' );
	}
}
