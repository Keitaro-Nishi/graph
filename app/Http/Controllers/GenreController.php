<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GenreController
{
	public function index(Request $request)
	{

		$Authrole = Auth::user()->role;
		$cityCD = Auth::user()->citycode;
		$result = Genre::where('bunrui', 1)->get();
		$result2 = Genre::where('bunrui',1)->where('gid1', 1)->get();



		if($cityCD == "00000"){
			$genres = Genre::all();
		}else{
			$genregid1 = array();
			$genres= Genre::where('citycode', $cityCD)->orderBy('gid1', 'ASC')->orderBy('gid2', 'ASC')->get();
			$genregid1 = DB::select('select gid1 from genre WHERE gid1=?',[2]);
			error_log("★★★★★★★");
			error_log($genregid1[0]);
		}

		return view('genre',compact('genres','result','result2'));
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
