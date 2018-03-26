<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Parameter;
class LineBotController
{
	public function callback(Request $request,$citycode)
	{
		$jsonObj = json_decode($request->getContent());

		$type = $jsonObj->{"events"}[0]->{"message"}->{"type"};
		$eventType = $jsonObj->{"events"}[0]->{"type"};
		//メッセージ取得
		$text = $jsonObj->{"events"}[0]->{"message"}->{"text"};

		//ReplyToken取得
		$replyToken = $jsonObj->{"events"}[0]->{"replyToken"};
		//ユーザーID取得
		$userID = $jsonObj->{"events"}[0]->{"source"}->{"userId"};

		error_log("★★★★★★★★★★★★★★text★★★★★★★★★★★★★★★".$text);
		error_log("★★★★★★★★★★★★★★replyToken★★★★★★★★★★★★★★★".$replyToken);


		$line_cat = Parameter::select('line_cat')->where('citycode', $citycode)->first();

		$response_format_text = [
				"type" => "text",
				"text" => "test"
		];

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
				'Authorization: Bearer ' . $line_cat
		));
		$result = curl_exec($ch);
		curl_close($ch);

	}
}