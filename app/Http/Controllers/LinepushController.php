<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Userinfo;
use App\Parameter;
use App\Code;
use App\Pushlog;
use App\Libs\Watson;

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
		$input = $this->requestall;
		$cityCD = Auth::user()->citycode;
		$line_cat = Parameter::select('line_cat')->where('citycode', $cityCD)->first();
		//日本語
		$sendids= $this->makeQuerry()->where('language', '01')->get();
		$uids = [];
		$count = 0;
		for ($i =0; $i < count($sendids); $i++){
			array_push($uids,trim($sendids[$i]->userid));
			$count = $count + 1;
			if($count == 150){
				$result = $this->lineSend($line_cat->line_cat,$uids,$input["sendmess"]);
				if($result == "NG"){
					return \Response::json(['status' => 'NG']);
				}
				$uids = [];
				$count = 0;
			}
		}
		if(count($uids) > 0){
			$result = $this->lineSend($line_cat->line_cat,$uids,$input["sendmess"]);
			if($result == "NG"){
				return \Response::json(['status' => 'NG']);
			}
		}
		//英語
		$sendids= $this->makeQuerry()->where('language', '02')->get();
		$uids = [];
		$count = 0;
		$watson = new Watson;
		$message = $watson->callLT($cityCD,"ja","en",$input["sendmess"]);
		for ($i =0; $i < count($sendids); $i++){
			array_push($uids,trim($sendids[$i]->userid));
			$count = $count + 1;
			if($count == 150){
				$result = $this->lineSend($line_cat->line_cat,$uids,$message);
				if($result == "NG"){
					return \Response::json(['status' => 'NG']);
				}
				$uids = [];
				$count = 0;
			}
		}
		if(count($uids) > 0){
			$result = $this->lineSend($line_cat->line_cat,$uids,$message);
			if($result == "NG"){
				return \Response::json(['status' => 'NG']);
			}
		}


		//ログの更新
		$input = $this->requestall;
		$target = $this->makeQuerry()->count();
		$pushlog = new Pushlog();
		$pushlog->citycode = $cityCD;
		$pushlog->time = Carbon::now();
		$pushlog->info = $input["info"];
		$pushlog->agek = $input["agek"];
		$pushlog->agem = $input["agem"];
		$pushlog->sex = $input["sex"];
		$pushlog->param1 = $input["option"][0];
		$pushlog->param2 = $input["option"][1];
		$pushlog->param3 = $input["option"][2];
		$pushlog->param4 = $input["option"][3];
		$pushlog->param5 = $input["option"][4];
		$pushlog->param6 = $input["option"][5];
		$pushlog->param7 = $input["option"][6];
		$pushlog->param8 = $input["option"][7];
		$pushlog->param9 = $input["option"][8];
		$pushlog->param10 = $input["option"][9];
		$pushlog->target = $target;
		$pushlog->type = (int)1;
		$pushlog->contents = $input["sendmess"];
		$pushlog->sender = Auth::user()->userid;
		$pushlog->save();

		return \Response::json(['status' => 'OK']);
	}

	public function lineSend($line_cat,$uids,$message){
		$response_format_text = [
				"to" => $uids,
				"messages" => [
						[
								"type" => "text",
								"text" => $message
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

