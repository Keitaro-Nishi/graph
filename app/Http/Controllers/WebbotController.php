<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Userinfo;
use App\Cvsdata;
use App\Libs\Watson;
use Carbon\Carbon;

class WebbotController
{
	public function index(Request $request)
	{
		$citycode = Auth::user()->citycode;
		$userid = Auth::user()->userid;
		$sender = 2;

		/*$userinfo = Userinfo::where('citycode', $citycode)->where('userid', $userid)->where('sender', $sender)->first();

		if(!$userinfo){

			$language = "";
			$sex = 0;
			$age = 999;

		}else{

			$language = $userinfo->language;
			$sex = $userinfo->sex;
			$age = $userinfo->age;

		}
		*/

		//return view('webbot',compact('citycode','userid','language','sex','age'));
		return view('webbot',compact('citycode','userid'));
	}

	public  function request(){
		$this->requestall = \Request::all();
		if ($this->requestall["param"] == "search"){
			return $this->search();
		}elseif($this->requestall["param"] == "watson"){
			return $this->callcvsKenshin();
		}else{
			return \Response::json(['status' => 'NG']);
		}
	}

	public function search()
	{
		$input = $this->requestall;
		$citycode = $input["citycode"];
		$userid = $input["userid"];
		$sender = $input["sender"];

		$userinfo = Userinfo::where('citycode', $citycode)->where('userid', $userid)->where('sender', $sender)->first();

		if(!$userinfo){

			$language = "";
			$sex = 0;
			$age = 999;

		}else{

			$language = $userinfo->language;
			$sex = $userinfo->sex;
			$age = $userinfo->age;

		}

		error_log($language);
		error_log($sex);
		error_log($age);

		return \Response::json(['language' =>$language,'sex' =>$sex,'age' =>$age]);
	}


	public function callcvsKenshin()
	{
		$cityCD = Auth::user()->citycode;
		$workspace = Parameter::select('cvs_ws_id2')->where('citycode', $cityCD)->first();
		$workspace_KenshinId = $workspace->cvs_ws_id2;

		$url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/".$workspace_KenshinId."/message?version=2017-04-21";
		$tdate = Carbon::now();

		$input = $this->requestall;
		$user = $input["user"];
		$paramdata = $input["paramdata"];
		$kbn = $input["kbn"];
		$text = $input["text"];

		$text= str_replace("\n","",$text);
		$data = array('input' => array("text" => $text));

		//URL置き換え
		$pattern = '(https?://[-_.!~*\'()a-zA-Z0-9;/?:@&=+$,%#]+)';
		$replacement = '[\1](\1)^';
		$resmess= mb_ereg_replace($pattern, $replacement, htmlspecialchars($resmess));
		//改行コードを置き換え
		$resmess = str_replace("\\n","<br>",$resmess);
		//error_log($resmess);
		return \Response::json(['text' => $resmess]);
		$watson = new Watson;

		if($kbn =="0"){
			$jsonString = $watson->callcvsKenshin($cityCD,$url,$data);
			$json = json_decode($jsonString, true);
			$conversation_id = $json["context"]["conversation_id"];
			$resmess= $json["output"]["text"][0];
			$conversation_node = $json["context"]["system"]["dialog_stack"][0]["dialog_node"];

			$cvsdatas = Cvsdata::where('citycode', $cityCD)->where('userid', $user)->first();

			if(!$cvsdatas){
				DB::table('cvsdata')->insert(['citycode'=> $cityCD,'userid' =>$user, 'conversationid' => $conversation_id,'dnode' =>$conversation_node,'time' =>$tdate]);
			}else{
				Cvsdata::where('citycode',$cityCD)->where('userid',$user)->update(['conversationid' => $conversation_id,'dnode' =>$conversation_node,'time' =>$tdate]);
			}
		}else{
			$cvsdatas = Cvsdata::where('citycode', $cityCD)->where('userid', $user)->first();
			$conversation_id = $cvsdatas->conversationid;
			$conversation_node= $cvsdatas->dnode;
			$conversation_time= $cvsdatas->time;

			$data["context"] = array("conversation_id" => $conversation_id,
				  "system" => array("dialog_stack" => array(array("dialog_node" => $conversation_node)),
							                                 "dialog_turn_counter" => 1,
							                                 "dialog_request_counter" => 1));

			$jsonString = $watson->callcvsKenshin($cityCD,$url,$data);
			$json = json_decode($jsonString, true);
			$resmess= $json["output"]["text"][0];
			$conversation_node = $json["context"]["system"]["dialog_stack"][0]["dialog_node"];

			Cvsdata::where('citycode',$cityCD)->where('userid',$user)->update(['conversationid' => $conversation_id,'dnode' =>$conversation_node,'time' =>$tdate]);
		}


	}
}