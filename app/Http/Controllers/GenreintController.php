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
		$results= Genre::where('bunrui', 1)->where('citycode', $cityCD)->get();
		return view('genreint',compact('results'));

	}

	public  function request(){
		$this->requestall = \Request::all();
		if ($this->requestall["param"] == "intentSearch"){
			return $this->insert();
		}else{
			return \Response::json(['status' => 'NG']);
		}
	}

	public function insert()
	{
		$input = $this->requestall;

		$param = $_POST['param'];
		$g1meisho= $_POST['g1meisho'];
		$g2meisho= $_POST['g2meisho'];
		$sword= $_POST['sword'];

		$data = "";
		error_log("★★★★★★★★★★★★★★★★★★g1meisho:".$g1meisho." g2meisho:".$g2meisho." param:".$param." sword:".$sword);


	}


}
