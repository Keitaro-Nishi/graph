<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Opinion;
use Illuminate\Support\Facades\DB;

class OpinionController
{
	public function index(Request $request)
	{

		$opinions = Opinion::all();
		$test =[];
		$test = $opinions;
		$jsonTest=json_encode($test);
		//error_log("★★★★★★★");
		//error_log($opinions[0]);

		//$opinion_json = json_encode($opinions);
		//return view('opinion',['opinions'=>$opinions]);
		return view('opinion')->with('opinions', $opinions);

	}

	public function delete(Request $request)
	{
		$deleteNo = $request->deleteno;
		//error_log("★★★★★★★");
		//error_log($deleteNo);
		//DB::delete('delete from opinion WHERE id=?',[$deleteNo]);

		$deleteopinion = Opinion::find($deleteNo);
		$deleteopinion->delete();

		return redirect('/opinion');
	}

}
