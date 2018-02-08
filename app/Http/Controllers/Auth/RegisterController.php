<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller {
	/*
	 * |--------------------------------------------------------------------------
	 * | Register Controller
	 * |--------------------------------------------------------------------------
	 * |
	 * | This controller handles the registration of new users as well as their
	 * | validation and creation. By default this controller uses a trait to
	 * | provide this functionality without requiring any additional code.
	 * |
	 */

	use RegistersUsers;

	/**
	 * Where to redirect users after registration.
	 *
	 * @var string
	 */
	protected $redirectTo = '/home';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */

	public function __construct() {
		$this->middleware ( 'auth' );
		//$this->middleware ( 'guest' );
	}


	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param array $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data) {
		return Validator::make ( $data, [
				'citycode' => 'required|string',
				'name' => 'required|string|max:255',
				'userid' => 'required|string|max:255|unique:users',
				'organization' => 'required|string|max:255',
				'password' => 'required|string|min:6|confirmed'
		] );
	}


	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param array $data
	 * @return \App\User
	 */
	protected function create(array $data) {

		return User::create ( [

				//'citycode' =>$data ['citycode'],
				'citycode' => '55555',
				'name' => $data ['name'],
				'userid' => $data ['userid'],
				'organization' => $data ['organization'],
				'password' => bcrypt ( $data ['password'] ),
				'role' => 0
				//'role' => '0'

		] );
	}
}
