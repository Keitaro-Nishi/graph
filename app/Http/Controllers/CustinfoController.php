<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use App\User;

class CustinfoController extends Controller
{
	public function index(Request $request)
	{
		$customers =DB::select('select * from users');
		return view('Custinfo',['customers'=>$customers]);
	}

	public function delete(Request $request)
	{
		$deleteno = $request->deletecode;
		DB::delete('delete from custinfo WHERE no=?',[$deleteno]);
		return redirect('/Custinfo');
	}

}

