<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Parameter;
use App\Message;
class LineBotController
{
	public function callback(Request $request,$citycode)
	{

		error_log("★★★★★★★★★★★★citycode★★★★★★★★★★★★★".$citycode);
		error_log("★★★★★★★★★★★★req★★★★★★★★★★★★★".$request->getContent());

		$jsonObj = json_decode($request->getContent());

		$eventType = $jsonObj->{"events"}[0]->{"type"};
		//ReplyToken取得
		$replyToken = $jsonObj->{"events"}[0]->{"replyToken"};

		//友達追加時の処理
		if($eventType == "follow"){
			$mess = Message::select('message')->where('citycode', $citycode)->where('id', 1)->first();
			$response_format_text = [
					"type" => "text",
					"text" => $mess->message
			];
			$this->linesend($citycode,$replyToken,$response_format_text);
			return;
		}

		error_log("★★★★★★★★★★★★type★★★★★★★★★★★★★".$type);
		$type = $jsonObj->{"events"}[0]->{"message"}->{"type"};
		//メッセージ取得
		$text = $jsonObj->{"events"}[0]->{"message"}->{"text"};
		//ユーザーID取得
		$userID = $jsonObj->{"events"}[0]->{"source"}->{"userId"};

		error_log("★★★★★★★★★★★★replyToken★★★★★★★★★★★★★".$replyToken);
		error_log("★★★★★★★★★★★★eventType★★★★★★★★★★★★★".$eventType);



	}

	public function linesend ($citycode,$replyToken,$response_format_text){
		$line_cat = Parameter::select('line_cat')->where('citycode', $citycode)->first();

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