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
		$genrearrays= array();


		if($cityCD == "00000"){
			//$genres = Genre::all();
		}else{
			$genres= Genre::where('citycode', $cityCD)->orderBy('gid1', 'ASC')->orderBy('gid2', 'ASC')->get();
			$genregid1 = DB::table('genre')->select('gid1')->where('citycode', $cityCD)->get();

			foreach ($genres as $value) {
				$bunrui = $value->bunrui;
				$daibunrui;
				$shoubunrui;
				$gid1 = $value->gid1;
				$gid2 = $value->gid2;
				$meisho = $value->meisho;

				if($bunrui == 1){
					$daibunrui = $meisho;
					$shoubunrui = '-';
				}

				if($bunrui == 2){
					$result = DB::table('genre')->select('meisho')->where('bunrui',1)->where('gid1',$gid1)->get();
					$shoubunrui = $meisho;
						foreach ($result as $result2) {
							$daibunrui= $result2->meisho;
						}
				}


				$genrearray= [
						'bunrui'=>$bunrui,
						'daibunrui'=>$daibunrui,
						'shoubunrui'=>$shoubunrui,
						'gid1'=>$gid1,
						'gid2'=>$gid2,
				];

				//$genrearray2= array_merge($genrearray, $genrearray2);
				//$genrearray2 = $genrearray2 + $genrearray;

				array_push($genrearrays, $genrearray);
			}

			/*
			foreach ($genregid1 as $value) {
				$row = $value->gid1;
				//error_log("●●●●●●●");
				//error_log($row);
				$genregid2 = DB::table('genre')->select('meisho')->where('bunrui',1)->where('gid1',$row)->get();
				foreach ($genregid2 as $value2) {
					$row2 = $value2->meisho;
					//error_log("★★★★★★★");
					//error_log($row2);
					//array_push($genrearray, $row2);
					$genrearray= [
							'daibunrui'=>$row2
					];
				}
			}*/
			//error_log(print_r($genres,true));
		}
		//error_log("●●●●●●●");
		error_log(print_r($genres,true));
		error_log(print_r($genrearrays,true));
		//return view('genre',compact('genrearrays'));
		return view('genre',['genrearrays'=>$genrearrays]);
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
