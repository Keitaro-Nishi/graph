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
		$deleteNo = $request->deleteno;
		error_log("★★★★★★★");
		error_log($deleteNo);
		DB::delete('delete from opinion WHERE no=?',[$deleteNo]);
		/*
		$deleteno = $request->deletecode;
		//DB::delete('delete from opinion WHERE no=?',[$deleteno]);
		$deleteopinion = Opinion::find($deleteno);
		$deleteopinion->delete();
		*/
		return redirect('/opinion');
	}

}
