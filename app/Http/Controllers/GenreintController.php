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
			return $this->intentSearch();
		}else{
			return \Response::json(['status' => 'NG']);
		}
	}

	public function intentSearch()
	{
		$workspace_id = getenv('CVS_WORKSPASE_ID');
		$username = getenv('CVS_USERNAME');
		$password = getenv('CVS_PASS');

		$input = $this->requestall;
		$param = $_POST['param'];
		$g1meisho= $_POST['g1meisho'];
		$g2meisho= $_POST['g2meisho'];
		$sword= $_POST['sword'];

		$data = "";
		error_log("★★★★★★★★★★★★★★★★★★g1meisho:".$g1meisho." g2meisho:".$g2meisho." param:".$param." sword:".$sword);

		global $url,$g1meisho,$workspace_id;
		$url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/".$workspace_id."/intents/".$g1meisho."/examples?version=2017-05-26&export=true";
		$jsonString = callWatson2();
		$json = json_decode($jsonString, true);
		$arr = array();
		foreach ($json["examples"] as $value){
			array_push($arr,$value["text"]);
		}
		echo json_encode($arr);

	}

	function callWatson2(){
		global $curl, $url, $username, $password, $data, $options;
		$curl = curl_init($url);
		$options = array(
				CURLOPT_HTTPHEADER => array(
						'Content-Type: application/json',
				),
				CURLOPT_USERPWD => $username . ':' . $password,
				CURLOPT_CUSTOMREQUEST => 'GET',
				CURLOPT_RETURNTRANSFER => true,
		);
		curl_setopt_array($curl, $options);
		return curl_exec($curl);
	}


}
