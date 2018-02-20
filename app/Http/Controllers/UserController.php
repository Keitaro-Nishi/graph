<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController
{
	/*public function __construct()
	{
		$this->middleware('auth');
	}
	*/

	public function index(Request $request)
	{
		//$users =DB::select('select * from users');
		$users = User::all();
		return view('users',['users'=>$users]);
	}

	public function delete(Request $request)
	{

		$deleteid = $request->deletecode;
		error_log(★★★★★★★★);
		error_log($deleteid);
		$deleteuser = User::find($deleteid);
		$deleteuser->delete();
		//DB::delete('delete from users WHERE userid=?',[$deleteid]);
		return redirect('/users');
	}

}
