<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller {



	public function login(Request $request) {
	   error_log(★★★★★★★★★★);
	   $errorMessage ="";
       $custid = $request->custid;
       $password = bcrypt($request->password);

       error_log($custid);

       /*$DB_customers =DB::select('select * from custinfo where custid = ?', [$custid]);
       error_log(★★★★★★★★★★);
       $DB_custid = $DB_customers->custid;
       $DB_password = $DB_customers->password;

       if (password_verify ( $password, $DB_password)) {
       error_log(★★★★★★★★★★);
       	session_regenerate_id ( true );
       	$_SESSION ["CUSTID"] = $custid;
       	//header ( "Location: Menu.blade.php" );
       	exit ();
       } else {
       	// 認証失敗
       	$errorMessage = "ユーザIDあるいはパスワードに誤りがあります。";
       }
       */
	}
}
