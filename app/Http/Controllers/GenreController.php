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
		//$result = Genre::where('bunrui', 1)->get();
		//$result2 = Genre::where('bunrui',1)->where('gid1', 1)->get();
		$genrearray= array();


		if($cityCD == "00000"){
			$genres = Genre::all();
		}else{
			$genres= Genre::where('citycode', $cityCD)->orderBy('gid1', 'ASC')->orderBy('gid2', 'ASC')->get();
			$genregid1 = DB::table('genre')->select('gid1')->where('citycode', $cityCD)->get();


			foreach ($genregid1 as $value) {
				$row = $value->gid1;
				error_log("●●●●●●●");
				error_log($row);
				$genregid2 = DB::table('genre')->select('meisho')->where('bunrui',1)->where('gid1',$row)->get();
				foreach ($genregid2 as $value2) {
					$row2 = $value2->meisho;
					error_log("★★★★★★★");
					error_log($row2);
					//$genrearray = $genrearray + $row2;
				}
			}



		}

		return view('genre',compact('genres'));
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
