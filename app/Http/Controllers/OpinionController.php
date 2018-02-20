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
		$deleteno = $request->deletecode;
		DB::delete('delete from opinion WHERE no=?',[$deleteno]);
		//$DeleteOpinion = Opinion::find($deleteno);
		//$DeleteOpinion->delete();
		return redirect('/opinion');
	}

}
