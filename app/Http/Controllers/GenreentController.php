<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Libs\Watson;

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

	public  function request(){
		$this->requestall = \Request::all();
		if ($this->requestall["param"] == "entitySearch"){
			return $this->entitySearch();
		}elseif($this->requestall["param"] == "entityUpdate"){
			return $this->entityUpdate();
		}elseif($this->requestall["param"] == "entityDelete"){
			return $this->entityDelete();
		}else{
			return \Response::json(['status' => 'NG']);
		}
	}

	function entitySearch(){

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

		$url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/".$workspace_id."/entities/".$g1meisho."/values/".urlencode($g2meisho)."/synonyms?version=2017-05-26";
		$jsonString = $watson->callWatson2($url,$username,$password);
		$json = json_decode($jsonString, true);
		$arr = array();
		foreach ($json["synonyms"] as $value){
			array_push($arr,$value["synonym"]);
		}
		return \Response::json($arr);

	}
	function entityUpdate(){

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

		$url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/".$workspace_id."/entities/".$g1meisho."/values/".urlencode($g2meisho)."/synonyms?version=2017-05-26";
		$data = array("synonym" => $sword);
		$jsonString = $watson->callWatson($url,$username,$password,$data);
		$json = json_decode($jsonString, true);
		if($json["synonym"] == $sword){
			return \Response::json(['status' => 'OK']);
		}else{
			return \Response::json(['status' => 'NG']);
		}
	}
	function entityDelete(){

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

		$url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/".$workspace_id."/entities/".$g1meisho."/values/".urlencode($g2meisho)."/synonyms/".urlencode($sword)."?version=2017-05-26";
		$result = $watson->callWatson3($url,$username,$password);

		error_log($result);
		if($result == "200"){
			return \Response::json(['status' => 'OK']);
		}else{
			return \Response::json(['status' => 'NG']);
		}
	}


}
