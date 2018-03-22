<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Opinion;
use Illuminate\Support\Facades\DB;
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

			$opinions = Opinion::all();

		}else{

			$opiniondata= Opinion::where('citycode', $cityCD)->get();

			foreach($opiniondata as $opinion){

				$citycode = $opinion->citycode;
				$id = $opinion->id;
				$userid = $opinion->userid;
				$timedata = date_create($opinion->time);
				$time = date_format($timedata , 'Y-m-d H:i:s');
				$opinion = $opinion->opinion;
				$sadness = $opinion->sadness;
				$joy = $opinion->joy;
				$fear = $opinion->fear;
				$disgust = $opinion->disgust;
				$anger = $opinion->anger;
				$checked = $opinion->checked;


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

			error_log("★★★★★★");
			error_log(print_r($opinions,true));

		}

		return view('opinion',['opinions'=>$opinions]);
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
