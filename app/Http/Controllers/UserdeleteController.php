<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
//use Input;

class UserdeleteController extends Controller
{
	public function delete(Request $request)
	{
		$deleteid = $request->deletecode;
		//DB::delete('delete from users WHERE userid=?',[$deleteid]);
		DB::delete('delete from users WHERE userid=?',['あ']);
		return redirect('/users');
	}
}

