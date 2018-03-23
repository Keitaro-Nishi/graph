<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Genre;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Libs\Watson;
use App\Parameter;

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
		}elseif($this->requestall["param"] == "intentUpdate"){
			return $this->intentUpdate();
		}elseif($this->requestall["param"] == "intentDelete"){
			return $this->intentDelete();
		}else{
			return \Response::json(['status' => 'NG']);
		}
	}

	public function intentSearch()
	{
		$cityCD = Auth::user()->citycode;
		$workspace = Parameter::select('cvs_ws_id1')->where('citycode', $cityCD)->first();
		$workspace_id = $workspace->cvs_ws_id1;
		$username = getenv('CVS_USERNAME');
		$password = getenv('CVS_PASS');

		$input = $this->requestall;
		$param = $input["param"];
		$g1meisho= $input["g1meisho"];
		$g2meisho= $input["g2meisho"];
		$sword= $input["sword"];
		$data = "";

		$watson = new Watson;

		$url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/".$workspace_id."/intents/".$g1meisho."/examples?version=2017-05-26&export=true";
		$jsonString = $watson->callcvsGet($cityCD,$url);
		$json = json_decode($jsonString, true);


		$arr = array();
		foreach ($json["examples"] as $value){
			array_push($arr,$value["text"]);
		}
		return \Response::json($arr);
	}

	public function intentUpdate(){

		$cityCD = Auth::user()->citycode;
		$workspace = Parameter::select('cvs_ws_id1')->where('citycode', $cityCD)->first();
		$workspace_id = $workspace->cvs_ws_id1;
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
		$jsonString = $watson->callcvsPost($cityCD,$url,$data);
		$json = json_decode($jsonString, true);

		if($json["text"] == $sword){
			return \Response::json(['status' => 'OK']);
		}else{
			return \Response::json(['status' => 'NG']);
		}
	}

	function intentDelete(){

		$cityCD = Auth::user()->citycode;
		$workspace = Parameter::select('cvs_ws_id1')->where('citycode', $cityCD)->first();
		$workspace_id = $workspace->cvs_ws_id1;
		$username = getenv('CVS_USERNAME');
		$password = getenv('CVS_PASS');

		$input = $this->requestall;
		$param = $input["param"];
		$g1meisho= $input["g1meisho"];
		$g2meisho= $input["g2meisho"];
		$sword= $input["sword"];

		$data = "";
		$watson = new Watson;

		$url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/".$workspace_id."/intents/".$g1meisho."/examples/".urlencode($sword)."?version=2017-05-26";
		$result = $watson->callcvsDelete($cityCD,$url);

		if($result == "200"){
			return \Response::json(['status' => 'OK']);
		}else{
			return \Response::json(['status' => 'NG']);
		}
	}
}