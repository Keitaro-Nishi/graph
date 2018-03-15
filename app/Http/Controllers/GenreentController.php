<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Libs\Watson;
use App\Parameter;

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

		$url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/".$workspace_id."/entities/".$g1meisho."/values/".urlencode($g2meisho)."/synonyms?version=2017-05-26";
		$jsonString = $watson->callcvsGet($cityCD,$url);
		$json = json_decode($jsonString, true);
		$arr = array();
		foreach ($json["synonyms"] as $value){
			array_push($arr,$value["synonym"]);
		}
		return \Response::json($arr);

	}
	function entityUpdate(){

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

		$url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/".$workspace_id."/entities/".$g1meisho."/values/".urlencode($g2meisho)."/synonyms?version=2017-05-26";
		$data = array("synonym" => $sword);
		$jsonString = $watson->callcvsPost($cityCD,$url,$data);
		$json = json_decode($jsonString, true);
		if($json["synonym"] == $sword){
			return \Response::json(['status' => 'OK']);
		}else{
			return \Response::json(['status' => 'NG']);
		}
	}
	function entityDelete(){

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

		$url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/".$workspace_id."/entities/".$g1meisho."/values/".urlencode($g2meisho)."/synonyms/".urlencode($sword)."?version=2017-05-26";
		$result = $watson->callcvsDelete($cityCD,$url);

		if($result == "200"){
			return \Response::json(['status' => 'OK']);
		}else{
			return \Response::json(['status' => 'NG']);
		}
	}


}
