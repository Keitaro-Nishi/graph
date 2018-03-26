<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Pushlog;
use App\User;
use App\Code;

class PushlogController
{

	public function index(Request $request)
	{

		$cityCD = Auth::user()->citycode;
		$pushloglist= array();
		$pushlogs= array();
		$codes = array();

		if($cityCD == "00000"){
			$pushlogdatas = Pushlog::orderBy('time', 'DESC')->get();

			foreach($pushlogdatas as $pushlogdata){

				$no = $pushlogdata->no;
				$timedata = date_create($pushlogdata->time);
				$time = date_format($timedata , 'Y-m-d H:i:s');
				$infodata = $pushlogdata->info;
				$agek = $pushlogdata->agek;
				$agem = $pushlogdata->agem;
				$sexdata = $pushlogdata->sex;
				$target = $pushlogdata->target;
				$typedata = $pushlogdata->type;
				$contents = $pushlogdata->contents;
				$senderdata = $pushlogdata->sender;
				$senders = User::select('name')->where('userid',$senderdata)->first();
				$sender = $senders->name;

				$typevalue = Code::select('meisho')->where('citycode',"00000")->where('code1',15)->where('code2',$typedata)->first();
				$type = $typevalue->meisho;

				if($infodata == 0){
					$info = "すべて";
				}elseif($infodata == 1){
					$info = "登録あり";
				}elseif($infodata == 2){
					$info = "登録なし";
				}

				if($sexdata == 0){
					$sex = "すべて";
				}elseif($sexdata== 1){
					$sex = "男性";
				}elseif($sexdata== 2){
					$sex = "女性";
				}

				if($agek == 999 or $agem == 999){
					$age = "すべて";
				}elseif($agek == $agem){
					$age = $agek."歳";
				}else{
					$age = $agek."歳 ～ ".$agem."歳";
				}

				$pushloglist= [

						'no'=>$no,
						'time'=>$time,
						'info'=>$info,
						'age'=>$age,
						'sex'=>$sex,
						'target'=>$target." 人",
						'type'=>$type,
						'contents'=>$contents,
						'sender'=>$sender,
				];

				array_push($pushlogs, $pushloglist);
			}
		}else{

			$pushlogdatas= Pushlog::where('citycode', $cityCD)->orderBy('time', 'DESC')->get();
			foreach($pushlogdatas as $pushlogdata){

				$no = $pushlogdata->no;
				$timedata = date_create($pushlogdata->time);
				$time = date_format($timedata , 'Y-m-d H:i:s');
				$infodata = $pushlogdata->info;
				$agek = $pushlogdata->agek;
				$agem = $pushlogdata->agem;
				$sexdata = $pushlogdata->sex;
				$target = $pushlogdata->target;
				$typedata = $pushlogdata->type;
				$contents = $pushlogdata->contents;
				$senderdata = $pushlogdata->sender;
				$senders = User::select('name')->where('citycode',$cityCD)->where('userid',$senderdata)->first();
				$sender = $senders->name;

				$typevalue = Code::select('meisho')->where('citycode',"00000")->where('code1',15)->where('code2',$typedata)->first();
				$type = $typevalue->meisho;

				if($infodata == 0){
					$info = "すべて";
				}elseif($infodata == 1){
					$info = "登録あり";
				}elseif($infodata == 2){
					$info = "登録なし";
				}

				if($sexdata == 0){
					$sex = "すべて";
				}elseif($sexdata== 1){
					$sex = "男性";
				}elseif($sexdata== 2){
					$sex = "女性";
				}

				if($agek == 999 or $agem == 999){
					$age = "すべて";
				}elseif($agek == $agem){
					$age = $agek."歳";
				}else{
					$age = $agek."歳 ～ ".$agem."歳";
				}

				$pushloglist= [

						'no'=>$no,
						'time'=>$time,
						'info'=>$info,
						'age'=>$age,
						'sex'=>$sex,
						'target'=>$target." 人",
						'type'=>$type,
						'contents'=>$contents,
						'sender'=>$sender,
				];

				array_push($pushlogs, $pushloglist);
			}
		}

		$pushlogvalue= json_encode($pushlogs);

		for ($i = 1; $i <= 10; $i++) {
			$count = Code::where('citycode', $cityCD)->where('code1', $i)->where('code2', '>', 0)->count();
			if($count > 0){
				//$records = Code::select('code1','code2','meisho')->where('citycode', $cityCD)->where('code1', $i)->orderBy('code2', 'ASC')->get();
				$records = Code::select('code1','meisho')->where('citycode', $cityCD)->where('code1', $i)->where('code2', 0)->orderBy('code2', 'ASC')->get();
				array_push($codes, json_decode($records,true));
			}
		}

		error_log("★★★★★★");
		error_log(print_r($codes,true));

		return view('pushlog',compact('pushlogs','pushlogvalue','codes'));
	}


	public function request() {
		$this->requestall = \Request::all ();
		if ($this->requestall ["param"] == "delete") {
			return $this->delete ();
		}else {
			return \Response::json(['status' => 'NG']);
		}
	}

	public function delete(){
		$input = $this->requestall;
		Pushlog::destroy($input["no"]);

		return \Response::json(['status' => 'OK']);

	}
}
