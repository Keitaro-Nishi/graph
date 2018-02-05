<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustinfoaddController extends Controller {


	public function add(Request $request) {
		return view ('Custinfoadd');
	}


	public function insert(Request $request) {
       $custid = $request->custid;
       $custname = $request->custname;
       $orgname = $request->orgname;
       $password = bcrypt($request->password);


       DB::insert('insert into custinfo (custid,custname,orgname,password) values (?,?,?,?)', [$custid, $custname,$orgname,$password]);
       return redirect('/Custinfo');
	}
}