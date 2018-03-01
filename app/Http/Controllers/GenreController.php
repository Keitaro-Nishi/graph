<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;
use Illuminate\Support\Facades\Auth;

class GenreController
{
	public function index(Request $request)
	{

		$Authrole = Auth::user()->role;
		$cityCD = Auth::user()->citycode;
		$result = Genre::where('bunrui', 1)->get();
		$result2 = Genre::where('bunrui',1)->where('gid1', 1)->get();



		if($cityCD == "00000"){
			//$genres = Genre::all();
			$genres = Genre::all()->orderBy('gid1', 'desc');
		}else{
			$genres= Genre::where('citycode', $cityCD)->orderBy('gid1', 'desc')->get();
		}

		return view('genre',compact('genres', 'result','result2'));
	}


	public function delete(Request $request)
	{
		$deleteNo = $request->deleteno;
		$deletegenre = Genre::find($deleteNo);
		$deletegenre->delete();

		return redirect('/genre');
	}


	public function init(Request $request)
	{
		$results= Genre::where('bunrui', 1)->get();
		return view('genreinit',compact('results'));

	}

}
