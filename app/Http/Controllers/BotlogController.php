<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Botlog;
class BotlogController
{
	public function index(Request $request)
	{
		$cityCD = Auth::user()->citycode;
		$botloglist= array();
		$botlogs= array();
		if($cityCD == "00000"){
			$botlogdatas = Botlog::all();
			foreach($botlogdatas as $botlogdata){
				$citycode = $botlogdata->citycode;
				$no = $botlogdata->no;
				$timedata = date_create($botlogdata->time);
				$time = date_format($timedata , 'Y-m-d H:i:s');
				$sender = $botlogdata->sender;
				$type = $botlogdata->type;
				$userid = $botlogdata->userid;
				$contents = $botlogdata->contents;
				$return = $botlogdata->return;
				$botloglist= [
						'citycode'=>$citycode,
						'no'=>$no,
						'time'=>$time,
						'sender'=>$sender,
						'type'=>$type,
						'userid'=>$userid,
						'contents'=>$contents,
						'return'=>$return,
				];
				array_push($botlogs, $botloglist);
			}
		}else{
			$botlogdatas= Botlog::where('citycode', $cityCD)->get();
			foreach($botlogdatas as $botlogdata){
				$citycode = $botlogdata->citycode;
				$no = $botlogdata->no;
				$timedata = date_create($botlogdata->time);
				$time = date_format($timedata , 'Y-m-d H:i:s');
				$sender = $botlogdata->sender;
				$type = $botlogdata->type;
				$userid = $botlogdata->userid;
				$contents = $botlogdata->contents;
				$return = $botlogdata->return;
				$botloglist= [
						'citycode'=>$citycode,
						'no'=>$no,
						'time'=>$time,
						'sender'=>$sender,
						'type'=>$type,
						'userid'=>$userid,
						'contents'=>$contents,
						'return'=>$return,
				];
				array_push($botlogs, $botloglist);
			}
		}
		$botlogvalue= json_encode($botlogs);
		return view('botlog',compact('botlogs','botlogvalue'));
	}
	public function request() {
		$this->requestall = \Request::all ();
		if ($this->requestall ["param"] == "update") {
			return $this->update ();
		} elseif ($this->requestall ["param"] == "delete") {
			error_log("???????????????????");
			return $this->delete ();
		} else {
			return \Response::json ( [
					'status' => 'NG'
			] );
		}
	}
	public function delete(){
		$input = $this->requestall;
		Botlog::destroy($input["nos"]);
		/*
		 $nos = $input ["nos"];
		 foreach ( $nos as $no ) {
		 DB::table('botlog')->where('no',$no)->delete();
		 }
		 */
		return \Response::json(['status' => 'OK']);
	}
}