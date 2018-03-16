<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Libs\Watson;
use App\Userinfo;
use App\Code;

class AttributeController
{
	private $requestall;

	public function index($citycode,$sender, $id)
	{
		$codes = array();
		$codesEn = array();

		for ($i = 1; $i <= 10; $i++) {
			$count = Code::where('citycode', $citycode)->where('code1', $i)->where('code2', '>', 0)->count();
			if($count > 0){
				$records = Code::select('code1','code2','meisho')->where('citycode', $citycode)->where('code1', $i)->orderBy('code2', 'ASC')->get();
				array_push($codes, json_decode($records,true));
			}
		}

		//英訳
		$watson = new Watson;
		foreach ($codes as $recode){
			$recodeEn = array();
			foreach ($recode as $value){
				$value["meisho"] = $watson->callLT($citycode,"ja","en",$value["meisho"]);
				error_log("★★★★★★★★★meisho★★★★★★★★★".$value["meisho"]);
				array_push($recodeEn,$value);
			}
			array_push($codesEn, $recodeEn);
		}

		$userinfo =  Userinfo::where('citycode', $citycode)->where('userid', $id)->where('sender', $sender)->first();
		if(!$userinfo){
			$userinfo = new Userinfo();
		}

		return view('attribute',['codes'=>$codesEn,'userinfo'=>$userinfo,'citycode'=>$citycode,'sender'=>$sender,'userid'=>$id]);
	}

	public  function request($citycode,$sender, $id){
		$this->requestall = \Request::all();
		if($this->requestall["param"] == "update"){
			return $this->update($citycode,$sender, $id);
		}elseif ($this->requestall["param"] == "delete"){
			return $this->delete($citycode,$sender, $id);
		}else{
			return \Response::json(['status' => 'NG']);
		}
	}

	public function update($citycode,$sender, $userid){
		$input = $this->requestall;
		$language = $input["language"];
		$sex = $input["sex"];
		$age = $input["age"];
		$param1 = $input["option"][0];
		$param2 = $input["option"][1];
		$param3 = $input["option"][2];
		$param4 = $input["option"][3];
		$param5 = $input["option"][4];
		$param6 = $input["option"][5];
		$param7 = $input["option"][6];
		$param8 = $input["option"][7];
		$param9 = $input["option"][8];
		$param10 = $input["option"][9];

		$save_value = [
				'citycode' => $citycode,
				'userid' => $userid,
				'sender' => $sender,
				'language' => $language,
				'sex' => $sex,
				'age' => $age,
				'param1' => $param1,
				'param2' => $param2,
				'param3' => $param3,
				'param4' => $param4,
				'param5' => $param5,
				'param6' => $param6,
				'param7' => $param7,
				'param8' => $param8,
				'param9' => $param9,
				'param10' => $param10,
				'updkbn' => '1'
		];

		$count = Userinfo::where('citycode', $citycode)->where('userid', $userid)->where('sender', $sender)->count();

		if($count > 0){
			$result = DB::table('userinfo')->where('citycode', $citycode)->where('userid', $userid)->where('sender', $sender)->update($save_value);
		}else{
			$result = DB::table('userinfo')->insert($save_value);
		}

		return \Response::json(['status' => 'OK']);
	}

	public function delete($citycode,$sender, $userid){
		$input = $this->requestall;

		$save_value = [
				'citycode' => $citycode,
				'userid' => $userid,
				'sender' => $sender,
				'language' => "01",
				'sex' => 0,
				'age' => 999,
				'param1' => 0,
				'param2' => 0,
				'param3' => 0,
				'param4' => 0,
				'param5' => 0,
				'param6' => 0,
				'param7' => 0,
				'param8' => 0,
				'param9' => 0,
				'param10' => 0,
				'updkbn' => "0"
		];
		$count = Userinfo::where('citycode', $citycode)->where('userid', $userid)->where('sender', $sender)->count();
		if($count > 0){
			$result = DB::table('userinfo')->where('citycode', $citycode)->where('userid', $userid)->where('sender', $sender)->update($save_value);
		}

		return \Response::json(['status' => 'OK']);
	}
}

