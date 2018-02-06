<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UseraddController extends Controller {


	public function add(Request $request) {
		return view ('useradd');
	}


	public function insert(Request $request) {

	     $userid= $request->userid;
       $name= $request->name;
       $organization= $request->organization;
       $password = bcrypt($request->password);


       DB::insert('insert into users (userid,name,email,organization,password,role,reserve) values (?,?,?,?,?,?,?)', [$userid,$name,'',$organization,$password,1,'']);
       return redirect('/users');
	}
}

