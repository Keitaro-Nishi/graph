<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GenreentController
{
	public function index(Request $request)
	{
		$cityCD = Auth::user()->citycode;
		$daibunruis= Genre::where('bunrui', 1)->where('citycode', $cityCD)->get();
		//$shoubunruis= Genre::where('bunrui', 2)->where('citycode', $cityCD)->get();

		return view('genreent',compact('daibunruis'));

	}


}
