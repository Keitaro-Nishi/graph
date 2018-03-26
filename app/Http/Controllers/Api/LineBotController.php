<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Libs\Watson;
use App\Userinfo;
use App\Parameter;
use App\Message;
use App\Code;
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
		$usefunction = Parameter::select('usefunction')->where('citycode', $this->citycode)->first();
		$unknownMess = Message::select('message')->where('citycode', $this->citycode)->where('id', 2)->first();
		for ($i =0; $i < count($functions); $i++){
			if($functions[$i]->meisho == $text){
				switch ($functions[$i]->code2) {
					//属性登録
					case 1:
						if(substr($usefunction->usefunction,$i,1) == 1){
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
						$this->locationMessage();
						return;
					//市政へのご意見
					case 6:
						$this->locationMessage();
						return;
					//周辺施設検索
					case 5:
						$this->locationMessage();
						return;
					default:
						break;
				}
			}
		}
	}

	public function imageMessage(){

	}

	public function locationMessage(){

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