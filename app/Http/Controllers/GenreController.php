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
		$genrelist= array();
		$genrelists= array();

			$genres= Genre::where('citycode', $cityCD)->orderBy('gid1', 'ASC')->orderBy('gid2', 'ASC')->get();
			$genregid1 = DB::table('genre')->select('gid1')->where('citycode', $cityCD)->get();
			$j1values = DB::table('genre')->where('citycode', $cityCD)->where('bunrui', 1)->get();

			foreach ($genres as $genre) {
				$citycode = $genre->citycode;
				$bunrui = $genre->bunrui;
				$daibunrui;
				$shoubunrui;
				$gid1 = $genre->gid1;
				$gid2 = $genre->gid2;
				$meisho = $genre->meisho;


				if($bunrui == 1){
					$daibunrui = $meisho;
					$shoubunrui = '-';
				}

				if($bunrui == 2){
					$bunruidata= DB::table('genre')->select('meisho')->where('bunrui',1)->where('gid1',$gid1)->first();
					$shoubunrui = $meisho;
					$daibunrui= $bunruidata->meisho;
				}

				$genrelist= [
						'citycode'=>$citycode,
						'bunrui'=>$bunrui,
						'daibunrui'=>$daibunrui,
						'shoubunrui'=>$shoubunrui,
						'gid1'=>$gid1,
						'gid2'=>$gid2,
				];

				array_push($genrelists, $genrelist);
			}


		return view('genre',compact('genrelists','j1values'));
	}

	public  function request(){
		$this->requestall = \Request::all();
		if ($this->requestall["param"] == "delete"){
			return $this->delete();
		}else{
			return \Response::json(['status' => 'NG']);
		}
	}


	public function delete()
	{
		$input = $this->requestall;
		$idsdata = $input["ids"];
		$cityCD = Auth::user()->citycode;

		foreach ($idsdata as $iddata) {
			$aos = explode(".", $iddata);
			$gid1 = $aos[0];
			$gid2 = $aos[1];

			if($gid2 == 0){
				DB::table('genre')->where('citycode',$cityCD)->where('gid1',$gid1)->delete();
			}else{
				DB::table('genre')->where('citycode',$cityCD)->where('gid1',$gid1)->where('gid2',$gid2)->delete();
			}
		}

		return \Response::json(['status' => 'OK']);
	}


	public function init(Request $request)
	{
		$results= Genre::where('bunrui', 1)->get();
		return view('genreinit',compact('results'));

	}

}
