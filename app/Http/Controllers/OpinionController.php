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
		$opinion_json = json_encode($opinions);
		return view('opinion',['opinions'=>$opinions]);

	}

	public function delete(Request $request)
	{
		$deleteNo = $request->deleteno;
		error_log("★★★★★★★");
		error_log($deleteNo);
		//DB::delete('delete from opinion WHERE id=?',[$deleteNo]);

		$deleteopinion = Opinion::find($deleteNo);
		$deleteopinion->delete();

		return redirect('/opinion');
	}

}
