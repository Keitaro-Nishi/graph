<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use Input;

class UserdeleteController extends Controller
{
	public function index(Request $request)
	{
		$deleteid = $request->deletecode;
		DB::delete('delete from users WHERE userid=?',[$deleteid]);
		return redirect('/users');
	}
}

