<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Opinion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OpinionController
{
	public function index(Request $request)
	{

		$Authrole = Auth::user()->role;
		$cityCD = Auth::user()->citycode;

		if($Authrole == 0){
			$opinions = Opinion::all();
		}
		if($Authrole == 1 or $Authrole == 2){
			$opinions= Opinion::where('citycode', $cityCD)->get();
		}

		//return view('opinion',['opinions'=>$opinions]);
		return view('opinion')->with('opinions', $opinions);
	}

	public function delete(Request $request)
	{
		$deleteNo = $request->deleteno;
		//error_log("★★★★★★★");
		//error_log($deleteNo);

		$deleteopinion = Opinion::find($deleteNo);
		$deleteopinion->delete();

		return redirect('/opinion');
	}

}
