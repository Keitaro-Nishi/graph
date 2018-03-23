<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Pushlog;

class PushlogController
{

	public function index(Request $request)
	{

		$cityCD = Auth::user()->citycode;
		$pushloglist= array();
		$pushlogs= array();

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
				$sender = $pushlogdata->sender;

				if($typedata == 1){
					$type = "テキスト";
				}

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
				$sender = $pushlogdata->sender;

				if($typedata == 1){
					$type = "テキスト";
				}

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
		return view('pushlog',compact('pushlogs','pushlogvalue'));
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
