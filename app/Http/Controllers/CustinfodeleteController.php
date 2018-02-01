<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CustinfodeleteController extends Controller
{
	public function delete(Request $request)
	{
		$deleteno = $request->deletecode;
		DB::delete('delete from custinfo WHERE no=?',[$deleteno]);
		return redirect('/Custinfo');
	}

}
