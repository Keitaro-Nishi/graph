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
		$paramlist = array();

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
				$param1 = $pushlogdata->param1;
				$param2 = $pushlogdata->param2;
				$param3 = $pushlogdata->param3;
				$param4 = $pushlogdata->param4;
				$param5 = $pushlogdata->param5;
				$param6 = $pushlogdata->param6;
				$param7 = $pushlogdata->param7;
				$param8 = $pushlogdata->param8;
				$param9 = $pushlogdata->param9;
				$param10 = $pushlogdata->para10;

				$paramlist= [

						1 =>$param1,
						'2'=>$param2,
						'3'=>$param3,
						'4'=>$param4,
						'5'=>$param5,
						'6'=>$param6,
						'7'=>$param7,
						'8'=>$param8,
						'9'=>$param9,
						'10'=>$param10,
				];

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

				for ($i = 1; $i <= 10; $i++) {
						$meishovalues = Code::select('meisho')->where('citycode', $cityCD)->where('code1', $i)->where('code2',paramlist[$i])->orderBy('code2', 'ASC')->get();
						foreach($meishovalues as $meishovalue){
							$meisho = $meishovalue->meisho;
							error_log("☆☆☆☆☆☆☆");
							error_log($meisho);
						}
				}

			}
		}

		$pushlogvalue= json_encode($pushlogs);

		for ($i = 1; $i <= 10; $i++) {
			$count = Code::where('citycode', $cityCD)->where('code1', $i)->where('code2', '>', 0)->count();
			if($count > 0){
				$records = Code::select('code1','code2','meisho')->where('citycode', $cityCD)->where('code1', $i)->orderBy('code2', 'ASC')->get();
				array_push($codes, json_decode($records,true));
			}
		}

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
