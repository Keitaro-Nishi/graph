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
				$target = $pushlogdata->target;
				$typedata = $pushlogdata->type;
				$contents = $pushlogdata->contents;
				$sender = $pushlogdata->sender;

				if($typedata == 1){
					$type = "テキスト";
				}

				$pushloglist= [

						'no'=>$no,
						'time'=>$time,
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
				$target = $pushlogdata->target;
				$typedata = $pushlogdata->type;
				$contents = $pushlogdata->contents;
				$sender = $pushlogdata->sender;

				if($typedata == 1){
					$type = "テキスト";
				}

				$pushloglist= [

						'no'=>$no,
						'time'=>$time,
						'target'=>$target,
						'type'=>$type,
						'contents'=>$contents,
						'sender'=>$sender,
				];

				array_push($pushlogs, $pushloglist);
			}
		}


		return view('pushlog',compact('pushlogs','pushlogdatas'));
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
