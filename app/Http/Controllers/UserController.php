<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use DB;
//use App\User;

class UserController extends Controller
{
	public function index(Request $request)
	{
		$users =DB::select('select * from users');
		return view('users',['users'=>$users]);
	}

}
