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
		$shoubunruilist= array();
		$shoubunruilists= array();

		$cityCD = Auth::user()->citycode;

		$daibunruis= Genre::where('bunrui', 1)->where('citycode', $cityCD)->get();
		$shoubunruis= Genre::where('bunrui', 2)->where('citycode', $cityCD)->orderBy('gid1', 'ASC')->orderBy('gid2', 'ASC')->get();

		foreach ($shoubunruis as $shoubunrui) {
			$gid1 = $shoubunrui->gid1;
			$gid2 = $shoubunrui->gid2;
			$meisho = $shoubunrui->meisho;


			$shoubunruilist= [
					'gid1'=>$gid1,
					'gid2'=>$gid2,
					'meisho'=>$meisho,
			];

			array_push($shoubunruilists, $shoubunruilist);
		}

		//error_log("●●●●●●●");
		//error_log(print_r($shoubunruilists,true));
		return view('genreent',compact('daibunruis','shoubunruis'));

	}


}
