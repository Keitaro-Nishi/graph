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



		if($cityCD == "00000"){
			$genres = Genre::all();
		}else{
			//$genregid1 = array();
			//$genregid2 = array();
			//$array = array();
			$genres= Genre::where('citycode', $cityCD)->orderBy('gid1', 'ASC')->orderBy('gid2', 'ASC')->get();
			$genregid1 = DB::table('genre')->select('gid1')->get();
			$array = (array)$genregid1;

			for ($i = 0; $i< count($array); $i++) {

				error_log($array[$i]);

			}

			/*
			for ($i = 0; $i< count($array); $i++) {
				//$row = array();
				$row = $array[$i];
				$genregid2= DB::table('genre')->select('meisho')->where('bunrui',1)->where('gid1',$row)->get();
			}

			error_log("○○○○○○○");
			error_log($genregid2);
			*/

			//$test = json_encode($genregid2);

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
