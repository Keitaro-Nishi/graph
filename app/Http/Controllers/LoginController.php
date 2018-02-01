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
       $custid = $request->logincustid;
       $password = $request->loginpassword;

       $DBcustomer =DB::select('select custid,password from custinfo where custid = ?', [$custid]);
       $DBcustid =$DBcustomer[0]->custid;
       $DBpassword = $DBcustomer[0] ->password;

       error_log("★★★★★★★★★★★★★★★");
       error_log($DBcustid);
       error_log($DBpassword);

       return view ('Menu');



       /*if (password_verify ( $password, $DB_password)) {
       	session_regenerate_id ( true );
       	$_SESSION ["CUSTID"] = $custid;
       	return view ('Menu');
       	//header ( "Location: Menu.blade.php" );
       	//exit ();
       } else {
       	// 認証失敗
       	$errorMessage = "ユーザIDあるいはパスワードに誤りがあります。";
       }
       */

	}
}
