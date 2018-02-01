<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller {



	public function login(Request $request) {
       $custid = $request->custid;
       $password = bcrypt($request->password);



	}
}
