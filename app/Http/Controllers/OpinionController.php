<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Opinion;

class OpinionController
{
	public function index(Request $request)
	{
		$cityCD = Auth::user()->citycode;
		if($cityCD = "00000"){
			$opinions = Opinion::all();
		}else{
			$opinions= Opinion::where('citycode', $cityCD)->get();
		}
		return view('opinion',['opinions'=>$opinions]);
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
