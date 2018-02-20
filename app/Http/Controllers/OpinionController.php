<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Opinion;


class OpinionController
{
	public function index(Request $request)
	{

		$opinions = Opinion::all();
		return view('opinion',['opinions'=>$opinions]);

	}

	public function delete(Request $request)
	{
		$DeleteNo = $request->deleteopinion;
		error_log(★★★★★★★★);
		error_log($DeleteNo);
		DB::delete('delete from opinion WHERE no=?',[$DeleteNo]);
		//$DeleteOpinion = Opinion::find($DeleteNo);
		//$DeleteOpinion->delete();
		return redirect('/opinion');
	}

}
