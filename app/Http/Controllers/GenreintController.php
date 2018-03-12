<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Libs\Watson;

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
		if ($this->requestall["param"] == "intentUpdate"){
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
		$param = $input["param"];
		$g1meisho= $input["g1meisho"];
		$g2meisho= $input["g2meisho"];
		$sword= $input["sword"];

		$data = "";
		$watson = new Watson;

		error_log("☆☆☆☆☆☆☆");
		error_log("g1meisho:".$g1meisho." g2meisho:".$g2meisho." param:".$param." sword:".$sword);

		$url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/".$workspace_id."/intents/".$g1meisho."/examples?version=2017-05-26&export=true";
		$jsonString = $watson->callWatson2($url,$username,$password);
		$json = json_decode($jsonString, true);

		error_log("●●●●●");
		error_log(print_r($json,true));

		$arr = array();
		foreach ($json["examples"] as $value){
			array_push($arr,$value["text"]);
		}


		return Response::json($arr);
		//return Response::json_encode($arr,JSON_PRETTY_PRINT);
		//echo json_encode($arr);
	}

	function intentUpdate(){

		$workspace_id = getenv('CVS_WORKSPASE_ID');
		$username = getenv('CVS_USERNAME');
		$password = getenv('CVS_PASS');

		$input = $this->requestall;
		$param = $input["param"];
		$g1meisho= $input["g1meisho"];
		$g2meisho= $input["g2meisho"];
		$sword= $input["sword"];

		$data = "";
		$watson = new Watson;

		$url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/".$workspace_id."/intents/".$g1meisho."/examples?version=2017-05-26";
		$data = array("text" => $sword);
		$jsonString = $watson->callWatson($url,$username,$password,$data);
		$json = json_decode($jsonString, true);
		if($json["text"] == $sword){
			echo json_encode("OK");
		}else{
			echo json_encode("NG");
		}
	}




}
