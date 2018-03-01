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
		$result = Genre::where('bunrui','1')->where('gid1', '1')->get();
		$resultmeisho = $result->meisho;

		error_log("★★★★★★★");
		error_log($resultmeisho);

		if($Authrole == 0){
			$genres = Genre::all();
		}
		if($Authrole == 1 or $Authrole == 2){
			$genres= Genre::where('citycode', $cityCD)->get();
		}

		return view('genre')->with('genres', $genres);
	}

	public function delete(Request $request)
	{
		$deleteNo = $request->deleteno;
		$deletegenre = Genre::find($deleteNo);
		$deletegenre->delete();

		return redirect('/genre');
	}

}
