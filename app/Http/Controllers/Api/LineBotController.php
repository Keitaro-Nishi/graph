<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Libs\Watson;
use App\Userinfo;
use App\Parameter;
use App\Message;
use App\Code;
use App\Cvsdata;
use App\Genre;
class LineBotController
{

	private $citycode;
	private $jsonRequest;

	public function callback(Request $request,$citycode)
	{

		error_log("★★★★★★★★★★★★citycode★★★★★★★★★★★★★".$citycode);
		error_log("★★★★★★★★★★★★req★★★★★★★★★★★★★".$request->getContent());
		error_log("★★★★★★★★★★★★SERVER★★★★★★★★★★★★★".$_SERVER["HTTP_HOST"]);

		$this->citycode = $citycode;
		$this->jsonRequest = json_decode($request->getContent());

		$eventType = $this->jsonRequest->{"events"}[0]->{"type"};

		switch ($eventType) {
			//友達追加時の処理
			case "follow":
				$this->followEvent();
				break;
			case "message":
				$this->messageEvent();
				break;
			default:
				error_log("★★★★★★★★★★★★eventType★★★★★★★★★★★★★".$eventType);
		}
	}

	public function followEvent (){
		error_log("★★★★★★★★★★★★followEvent★★★★★★★★★★★★★");
		$mess = Message::select('message')->where('citycode', $this->citycode)->where('id', 1)->first();
		$response_format_text = [
				"type" => "text",
				"text" => $mess->message
		];
		$this->linesend($response_format_text);
	}

	public function messageEvent(){
		error_log("★★★★★★★★★★★★messageEvent★★★★★★★★★★★★★");
		$type = $this->jsonRequest->{"events"}[0]->{"message"}->{"type"};
		error_log("★★★★★★★★★★★★type★★★★★★★★★★★★★".$type);

		switch ($type) {
			case "text":
				$this->textMessage();
				break;
			case "image":
				$this->imageMessage();
				break;
			case "location":
				$this->locationMessage();
				break;
			default:
				error_log("★★★★★★★★★★★★type★★★★★★★★★★★★★".$type);
		}
	}

	public function textMessage(){
		//メッセージ取得
		$text = $this->jsonRequest->{"events"}[0]->{"message"}->{"text"};
		//ユーザーID取得
		$userID = $this->jsonRequest->{"events"}[0]->{"source"}->{"userId"};

		$functions = Code::where('citycode', '00000')->where('code1', (int)13)->orderBy('code2', 'ASC')->get();
		$parameter = Parameter::where('citycode', $this->citycode)->first();
		$unknownMess = Message::select('message')->where('citycode', $this->citycode)->where('id', 2)->first();

		//メニュー選択
		for ($i =0; $i < count($functions); $i++){
			if($functions[$i]->meisho == $text){
				switch ($functions[$i]->code2) {
					//属性登録
					case 1:
						$this->userinfoUpdate(1);
						if(substr($parameter->usefunction,$i,1) == 1){
							$mess = Message::select('message')->where('citycode', $this->citycode)->where('id', 3)->first();
							$messurl = $mess->message.(empty($_SERVER["HTTPS"]) ? "http://" : "https://").$_SERVER["HTTP_HOST"]."/attribute/".$this->citycode."/1/".$userID;
							$this->linesendtext($messurl);
						}else{
							$this->linesendtext($unknownMess->message);
						}
						return;
					//検診相談
					case 2:
						$this->imageMessage();
						return;
					//問い合わせ
					case 3:
						$this->locationMessage();
						return;
					//ごみの分別
					case 4:
						$this->locationMessage();
						return;
					//周辺施設検索
					case 5:
						$this->userinfoUpdate(5);
						if(substr($parameter->usefunction,$i,1) == 1){
							$mess = Message::select('message')->where('citycode', $this->citycode)->where('id', 5)->first();
							$url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/".$parameter->cvs_ws_id1."/message?version=2017-04-21";
							$this->callCvs($url,"初回");
							$this->linesendtext($mess->message);
						}else{
							$this->linesendtext($unknownMess->message);
						}
						return;
					//市政へのご意見
					case 6:
						$this->locationMessage();
						return;
					default:
						break;
				}
			}
		}

		//メニュー選択済み
		$userinfo = Userinfo::where('citycode', $this->citycode)->where('userid', $userID)->where('sender', (int)1)->first();
		$modeflg = false;
		if($userinfo){
			//10分経過でリセット
			$btime = new \DateTime($userinfo->time);
			$tdate = new \DateTime(Carbon::now());
			$timelag = $tdate->format('YmdHis') - $btime->format('YmdHis');
			if($timelag > 1000){
				$modeflg = true;
			}
		}else{
			$modeflg = true;
		}

		if($modeflg){
			$mess = Message::select('message')->where('citycode', $this->citycode)->where('id', 6)->first();
			$this->linesendtext($mess->message);
			return;
		}

		error_log("★★★★★★★★★★★★userinfo->sposi★★★★★★★★★★★★★".$userinfo->sposi);

		//メニューによる振り分け
		switch ($userinfo->sposi) {
			//属性登録
			case 1:
				$mess = Message::select('message')->where('citycode', $this->citycode)->where('id', 6)->first();
				$this->linesendtext($mess->message);
				return;
			//検診相談
			case 2:

				return;
			//問い合わせ
			case 3:

				return;
			//ごみの分別
			case 4:

				return;
			//周辺施設検索
			case 5:

				return;
			//市政へのご意見
			case 6:

				return;
			//周辺施設検索
			case 5:
				$this->shisetu($parameter->cvs_ws_id1);
				return;
			default:
				break;
		}
	}

	public function imageMessage(){

	}

	public function locationMessage(){

	}

	//周辺施設検索
	public function shisetu($wsid){
		error_log("★★★★★★★★★★★★周辺施設検索★★★★★★★★★★★★★");
		//メッセージ取得
		$text = $this->jsonRequest->{"events"}[0]->{"message"}->{"text"};
		//ユーザーID取得
		$userID = $this->jsonRequest->{"events"}[0]->{"source"}->{"userId"};

		$url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/".$wsid."/message?version=2017-04-21";
		//改行コードを取り除く
		$text= str_replace("\n","",$text);
		$data = array('input' => array("text" => $text));

		$cvsdata = Cvsdata::where('citycode', $this->citycode)->where('userid', $userID)->first();
		$data["context"] = array("conversation_id" => $cvsdata->conversationid,
				"system" => array("dialog_stack" => array(array("dialog_node" => $cvsdata->dnode)),
						"dialog_turn_counter" => 1,
						"dialog_request_counter" => 1));
		$watson = new Watson;
		$jsonString = $watson->callcvsPost($this->citycode,$url,$data);
		$json = json_decode($jsonString, true);

		$genre = $json["output"]["text"][0];
		error_log("★★★★★★★★★★★★genre★★★★★★★★★★★★★".$genre);
		$genreB = explode(".", $genre);
		if($genreB[0] == 0){
			$resmess = "お探しの施設はありませんでした。";
		}else{
			$result = Genre::select('meisho')->where('citycode', $this->citycode)->where('gid1',$genreB[0])->where('gid2',$genreB[0])->first();
			$resmess = "『".$result->meisho."』について周辺検索します。位置情報を送信してください。";
			$tdate = Carbon::now();
			$save_value = [
					'search' => $genre,
					'time' => $tdate
			];
			$result = DB::table('userinfo')->where('citycode', $this->citycode)->where('userid', $userID)->update($save_value);
		}
		$this->linesendtext($resmess);
	}

	public function callCvs($url,$text){
		$data = array('input' => array("text" => $text));
		$watson = new Watson;
		$jsonString = $watson->callcvsPost($this->citycode,$url,$data);
		$json = json_decode($jsonString, true);
		$conversation_id = $json["context"]["conversation_id"];
		$resmess= $json["output"]["text"][0];
		//改行コードを置き換え
		$resmess = str_replace("\\n","\n",$resmess);
		$conversation_node = $json["context"]["system"]["dialog_stack"][0]["dialog_node"];
		$userID = $this->jsonRequest->{"events"}[0]->{"source"}->{"userId"};
		$tdate = Carbon::now();
		$save_value = [
				'citycode' => $this->citycode,
				'userid' => $userID,
				'conversationid' => $conversation_id,
				'dnode' => $conversation_node,
				'time' => $tdate
		];

		$count = Cvsdata::where('citycode', $this->citycode)->where('userid', $userID)->count();

		if($count > 0){
			$result = DB::table('cvsdata')->where('citycode', $this->citycode)->where('userid', $userID)->update($save_value);
		}else{
			$result = DB::table('cvsdata')->insert($save_value);
		}
		return $resmess;
	}

	public function userinfoUpdate($mode){
		$userID = $this->jsonRequest->{"events"}[0]->{"source"}->{"userId"};
		$tdate = Carbon::now();
		$count = Userinfo::where('citycode', $this->citycode)->where('userid', $userID)->where('sender', (int)1)->count();
		if($count > 0){
			$save_value = [
					'sposi' => $mode,
					'time' => $tdate
			];
			$result = DB::table('userinfo')->where('citycode', $this->citycode)->where('userid', $userID)->update($save_value);
		}else{
			$save_value = [
					'citycode' => $this->citycode,
					'sender' => (int)1,
					'userid' => $userID,
					'sex' => (int)0,
					'age' => (int)999,
					'sposi' => $mode,
					'time' => $tdate
			];
			$result = DB::table('userinfo')->insert($save_value);
		}
	}

	public function linesendtext($text){
		$userID = $this->jsonRequest->{"events"}[0]->{"source"}->{"userId"};
		$lang = Userinfo::select('language')->where('citycode', $this->citycode)->where('userid', $userID)->where('sender', (int)1)->first();
		if($lang->language == "02"){
			$watson = new Watson;
			$text= $watson->callLT($this->citycode,"ja","en",$text);
		}
		$response_format_text = [
				"type" => "text",
				"text" => $text
		];
		$this->linesend($response_format_text);
	}

	public function linesend ($response_format_text){

		//ReplyToken取得
		$replyToken = $this->jsonRequest->{"events"}[0]->{"replyToken"};

		$line_cat = Parameter::select('line_cat')->where('citycode', $this->citycode)->first();

		$post_data = [
				"replyToken" => $replyToken,
				"messages" => [$response_format_text]
		];

		$ch = curl_init("https://api.line.me/v2/bot/message/reply");
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json; charser=UTF-8',
				'Authorization: Bearer ' . $line_cat->line_cat
		));
		$result = curl_exec($ch);
		curl_close($ch);
	}
}