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
			$pushlogdatas = Pushlog::all();

			foreach($pushlogdatas as $pushlogdata){

				$no = $pushlogdata->no;
				$timedata = date_create($pushlogdata->time);
				$time = date_format($timedata , 'Y-m-d H:i:s');
				$infodata = $pushlogdata->info;
				$agek = $pushlogdata->agek;
				$agem = $pushlogdata->agem;
				$sex = $pushlogdata->sex;
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

				$pushloglist= [

						'no'=>$no,
						'time'=>$time,
						'info'=>$info,
						'age'=>$agek."歳から".$agem."歳",
						'sex'=>$sex,
						'target'=>$target,
						'type'=>$type,
						'contents'=>$contents,
						'sender'=>$sender,
				];

				array_push($pushlogs, $pushloglist);
			}
		}else{

			$pushlogdatas= Pushlog::where('citycode', $cityCD)->get();
			foreach($pushlogdatas as $pushlogdata){

				$no = $pushlogdata->no;
				$timedata = date_create($pushlogdata->time);
				$time = date_format($timedata , 'Y-m-d H:i:s');
				$infodata = $pushlogdata->info;
				$agek = $pushlogdata->agek;
				$agem = $pushlogdata->agem;
				$sex = $pushlogdata->sex;
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

				$pushloglist= [

						'no'=>$no,
						'time'=>$time,
						'info'=>$info,
						'age'=>$agek."歳～".$agem."歳",
						'sex'=>$sex,
						'target'=>$target,
						'type'=>$type,
						'contents'=>$contents,
						'sender'=>$sender,
				];

				array_push($pushlogs, $pushloglist);
			}
		}

		error_log("★★★");
		error_log(print_r($pushlogs,true));
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
