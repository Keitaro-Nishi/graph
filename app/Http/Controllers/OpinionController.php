<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Opinion;
use Illuminate\Support\Facades\Auth;
class OpinionController
{
	public function index(Request $request)
	{
		$Authrole = Auth::user()->role;
		$cityCD = Auth::user()->citycode;
		$opinionlist= array();
		$opinions= array();
		if($cityCD == "00000"){
			$opiniondatas = Opinion::all();
			foreach($opiniondatas as $opiniondata){
				$citycode = $opiniondata->citycode;
				$id = $opiniondata->id;
				$userid = $opiniondata->userid;
				$timedata = date_create($opiniondata->time);
				$time = date_format($timedata , 'Y/m/d H:i:s');
				$opinion = $opiniondata->opinion;
				$sadness = $opiniondata->sadness;
				$joy = $opiniondata->joy;
				$fear = $opiniondata->fear;
				$disgust = $opiniondata->disgust;
				$anger = $opiniondata->anger;
				$checked = $opiniondata->checked;
				$opinionlist= [
						'citycode'=>$citycode,
						'id'=>$id,
						'userid'=>$userid,
						'time'=>$time,
						'opinion'=>$opinion,
						'sadness'=>$sadness,
						'joy'=>$joy,
						'fear'=>$fear,
						'disgust'=>$disgust,
						'anger'=>$anger,
						'checked'=>$checked,
				];
				array_push($opinions, $opinionlist);
			}
		}else{
			$opiniondatas= Opinion::where('citycode', $cityCD)->get();
			foreach($opiniondatas as $opiniondata){
				$citycode = $opiniondata->citycode;
				$id = $opiniondata->id;
				$userid = $opiniondata->userid;
				$timedata = date_create($opiniondata->time);
				$time = date_format($timedata , 'Y/m/d H:i:s');
				$opinion = $opiniondata->opinion;
				$sadness = $opiniondata->sadness;
				$joy = $opiniondata->joy;
				$fear = $opiniondata->fear;
				$disgust = $opiniondata->disgust;
				$anger = $opiniondata->anger;
				$checked = $opiniondata->checked;
				$opinionlist= [
						'citycode'=>$citycode,
						'id'=>$id,
						'userid'=>$userid,
						'time'=>$time,
						'opinion'=>$opinion,
						'sadness'=>$sadness,
						'joy'=>$joy,
						'fear'=>$fear,
						'disgust'=>$disgust,
						'anger'=>$anger,
						'checked'=>$checked,
				];
				array_push($opinions, $opinionlist);
			}
		}
		$opinionvalue= json_encode($opinions);
		return view('opinion',compact('opinions','opinionvalue'));
	}
	public  function request(){
		$this->requestall = \Request::all();
		if($this->requestall["param"] == "delete"){
			return $this->delete();
		}else{
			return \Response::json(['status' => 'NG']);
		}
	}
	public function delete()
	{
		$input = $this->requestall;
		Opinion::destroy($input["opinionids"]);
		return \Response::json(['status' => 'OK']);
	}
}