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
		global $workspace_id,$username,$password,$url,$g1meisho;

		$workspace_id = getenv('CVS_WORKSPASE_ID');
		$username = getenv('CVS_USERNAME');
		$password = getenv('CVS_PASS');

		$input = $this->requestall;
		$param = $input["param"];
		$g1meisho= $input["g1meisho"];
		$g2meisho= $input["g2meisho"];
		$sword= $input["sword"];

		$data = "";

		//error_log("☆☆☆☆☆☆☆");
		//error_log("g1meisho:".$g1meisho." g2meisho:".$g2meisho." param:".$param." sword:".$sword);

		$url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/".$workspace_id."/intents/".$g1meisho."/examples?version=2017-05-26&export=true";
		$jsonString = $this->callWatson2();
		$json = json_decode($jsonString, true);
		error_log("●●●●●●");
		error_log(print_r($json,true));

		$arr = array();
		foreach ($json["examples"] as $value){
			array_push($arr,$value["text"]);
		}
		error_log("☆☆☆☆☆☆☆");


		return Response::json($arr);
		//Response::json_encode($arr,JSON_PRETTY_PRINT);
		//echo json_encode($arr);
	}

	public function callWatson2(){
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
