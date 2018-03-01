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


		$resultmeisho = $result2->meisho;


		if($cityCD == "00000"){
			$genres = Genre::all();
		}else{
			$genres= Genre::where('citycode', $cityCD)->get();
		}

		//return view('genre')->with('genres', $genres);
		return view('genre',compact('genres', 'resultmeisho'));
	}

	public function delete(Request $request)
	{
		$deleteNo = $request->deleteno;
		$deletegenre = Genre::find($deleteNo);
		$deletegenre->delete();

		return redirect('/genre');
	}

}
