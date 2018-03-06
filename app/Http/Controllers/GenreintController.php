<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GenreintController
{
	public function index(Request $request)
	{
		$cityCD = Auth::user()->citycode;
		//$results= Genre::where('bunrui', 1)->get();
		$results = DB::table('genre')->where('citycode', $cityCD)->where('bunrui', 1)->get();
		return view('genreinit',compact('results'));

	}


}
