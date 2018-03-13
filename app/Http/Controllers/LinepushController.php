<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Userinfo;
use App\Parameter;
use App\Code;

class LinepushController
{
	private $requestall;

	public function index(Request $request)
	{
		$cityCD = Auth::user()->citycode;

		$codes = array();

		for ($i = 1; $i <= 10; $i++) {
			$count = Code::where('citycode', $cityCD)->where('code1', $i)->where('code2', '>', 0)->count();
			if($count > 0){
				$records = Code::select('code1','code2','meisho')->where('citycode', $cityCD)->where('code1', $i)->orderBy('code2', 'ASC')->get();
				array_push($codes, json_decode($records,true));
			}
		}

		$hitcount = Userinfo::where('citycode', $cityCD)->where('sender', (int)1)->count();
		return view('linepush',['codes'=>$codes,'hitcount'=>$hitcount]);
	}

	public  function request(){
		$this->requestall = \Request::all();
		if($this->requestall["param"] == "search"){
			return $this->search();
		}elseif ($this->requestall["param"] == "send"){
			return $this->send();
		}else{
			return \Response::json(['status' => 'NG']);
		}
	}

	public function search(){
		$hitcount = $this->makeQuerry()->count();
		return \Response::json(['hitcount' => $hitcount]);
	}

	public function makeQuerry(){
		$input = $this->requestall;
		$cityCD = Auth::user()->citycode;
		$q = Userinfo::query();
		$q->where('citycode', $cityCD);
		$q->where('sender', (int)1);
		switch ($input["info"]) {
			//全て
			case 0:

				break;
				//属性登録あり
			case 1:
				$q->where('updkbn', '1');
				if($input["agek"] != 999){
					$q->where('age', '>=', $input["agek"]);
					if($input["agem"] != 999){
						$q->where('age', '<=', $input["agem"]);
					}
				}
				if($input["sex"] > 0){
					$q->where('sex', $input["sex"]);
				}
				for ($i = 1; $i <= 10; $i++) {
					if($input["option"][$i-1] > 0){
						$q->where('param'.$i, $input["option"][$i-1]);
					}
				}
				break;
				//属性登録なし
			case 2:
				$q->where('updkbn', '0');
				break;
		}
		return $q;
	}

	public function send()
	{
		//jsonを作成し、LINEに送信
		$cityCD = Auth::user()->citycode;
		$line_cat = Parameter::select('line_cat')->where('citycode', $cityCD)->first();
		error_log("★★★★★★★★line_cat★★★★★★★★★★".$line_cat);
		$sendids= $this->makeQuerry()->get();
		//$sendids = json_decode($idsresult,true);
		$uids = [];
		$count = 0;
		error_log("★★★★★★★★★sendids.length★★★★★★★★★".count($sendids));
		for ($i =0; $i < count($sendids); $i++){
			array_push($uids,trim($sendids[$i]->userid));
			$count = $count + 1;
			if($count == 150){
				$result = $this->lineSend($line_cat->line_cat,$uids);
				if($result == "NG"){
					return \Response::json(['status' => 'NG']);
				}
				$uids = [];
				$count = 0;
			}
		}
		error_log("★★★★★★★★★uids.length★★★★★★★★★".count($uids));
		if(count($uids) > 0){
			$result = $this->lineSend($line_cat->line_cat,$uids);
			if($result == "NG"){
				return \Response::json(['status' => 'NG']);
			}
		}

		return \Response::json(['status' => 'OK']);
	}

	public function lineSend($line_cat,$uids){
		$input = $this->requestall;
		error_log("★★★★★★★★line_cat2★★★★★★★★★★".$line_cat);
		error_log("★★★★★★★★★uids★★★★★★★★★".$uids[0]);
		$response_format_text = [
				"to" => $uids,
				"messages" => [
						[
								"type" => "text",
								"text" => $input["sendmess"]
						]
				]
		];

		$ch = curl_init("https://api.line.me/v2/bot/message/multicast");
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response_format_text));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json; charser=UTF-8',
				'Authorization: Bearer ' . $line_cat
		));
		$result = curl_exec($ch);
		if(!curl_errno($ch)) {
			$info = curl_getinfo($ch);
			curl_close($ch);
			error_log("★★★★★★★★★http_code★★★★★★★★★".$info['http_code']);
			if($info['http_code'] == "200"){
				return "OK";
			}else{
				return "NG";
			}
		}else{
			curl_close($ch);
			return "NG";
		}
	}

}

