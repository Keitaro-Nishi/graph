<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CallWatsonController
{
	public function index(Request $request)
	{
		$workspace_id = getenv('CVS_WORKSPASE_ID');
		$username = getenv('CVS_USERNAME');
		$password = getenv('CVS_PASS');

		error_log("★★★★★★★");
		error_log($workspace_id);
		error_log($username);
		error_log($password);
	}

}
