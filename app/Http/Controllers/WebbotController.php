<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Userinfo;

class WebbotController
{
	public function index(Request $request)
	{
		$citycode = Auth::user()->citycode;
		$userid = Auth::user()->userid;
		$sender = 2;

		$userinfo = Userinfo::where('citycode', $citycode)->where('userid', $userid)->where('sender', $sender)->first();
		//$language = $userinfo->language;
		$sex = $userinfo->sex;
		$age = $userinfo->age;

		error_log("☆☆☆☆☆");
		//error_log($language);
		error_log($sex);
		error_log($age);

		return view('webbot',compact('citycode','userid','userinfo'));
	}
}