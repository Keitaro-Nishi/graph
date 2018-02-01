<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller {


	public function index(Request $request) {
		return view ('Login');
	}


	public function login(Request $request) {

	   $errorMessage ="";
       $custid = $request->custid;
       $password = $request->password;



       $DB_customers =DB::select('select * from custinfo where custid = ?', [$custid]);
       $DB_custid = $DB_customers->custid;
       $DB_password = $DB_customers->password;

       if (password_verify ( $password, $DB_password)) {
       	session_regenerate_id ( true );
       	$_SESSION ["CUSTID"] = $custid;
       	return view ('Menu');
       	//header ( "Location: Menu.blade.php" );
       	//exit ();
       } else {
       	// 認証失敗
       	$errorMessage = "ユーザIDあるいはパスワードに誤りがあります。";
       }

	}
}
