<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Events\Logined;
use App\Events\Logouted;

class LoginController extends Controller {
	/*
	 * |--------------------------------------------------------------------------
	 * | Login Controller
	 * |--------------------------------------------------------------------------
	 * |
	 * | This controller handles authenticating users for the application and
	 * | redirecting them to your home screen. The controller uses a trait
	 * | to conveniently provide its functionality to your applications.
	 * |
	 */

	use AuthenticatesUsers;

	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */
	protected $redirectTo = '/home';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */

	/*
	 * public function __construct()
	 * {
	 * $this->middleware('guest')->except('logout');
	 * }
	 */
	protected function authenticated(Request $request, $user) {
		// ログインイベントを発火させ最終ログイン日時を記録する
		event ( new Logined () );
	}

	public function showLoginForm()
	{
		if (Auth::check()) {
			return redirect ( '/home' );
		}else{
		return view('auth.login');
		}
	}

	public function logout(Request $request) {
		event ( new Logouted () );

		$this->guard ()->logout ();

		$request->session ()->flush ();

		$request->session ()->regenerate ();

		return redirect ( '/login' );
	}
	public function username() {
		return 'userid';
	}
}
