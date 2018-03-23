<?php

namespace app\Libs;

class Watson{

	public function callcvsPost($cityCD,$url,$data){

		$username = getenv('CVS_USERNAME');
		$password = getenv('CVS_PASS');

		$curl = curl_init($url);
		$options = array(
				CURLOPT_HTTPHEADER => array(
						'Content-Type: application/json',
				),
				CURLOPT_USERPWD => $username . ':' . $password,
				CURLOPT_POST => true,
				CURLOPT_POSTFIELDS => json_encode($data),
				CURLOPT_RETURNTRANSFER => true,
		);
		curl_setopt_array($curl, $options);

		return curl_exec($curl);

	}


	function callcvsGet($cityCD,$url){

		$username = getenv('CVS_USERNAME');
		$password = getenv('CVS_PASS');

		$curl = curl_init($url);
		$options = array(
				CURLOPT_HTTPHEADER => array(
						'Content-Type: application/json',
				),
				CURLOPT_USERPWD => $username . ':' . $password,
				CURLOPT_CUSTOMREQUEST => 'GET',
				CURLOPT_RETURNTRANSFER => true,
		);
		curl_setopt_array($curl, $options);
		return curl_exec($curl);
	}


	function callcvsDelete($cityCD,$url){

		$username = getenv('CVS_USERNAME');
		$password = getenv('CVS_PASS');

		$curl = curl_init($url);
		$options = array(
				CURLOPT_HTTPHEADER => array(
						'Content-Type: application/json',
				),
				CURLOPT_USERPWD => $username . ':' . $password,
				CURLOPT_CUSTOMREQUEST => 'DELETE',
				CURLOPT_RETURNTRANSFER => true,
		);
		curl_setopt_array($curl, $options);
		curl_exec($curl);
		return curl_getinfo($curl, CURLINFO_HTTP_CODE);
	}

	function callLT($cityCD,$source,$target,$text){

		$LTuser = getenv('LT_USER');
		$LTpass = getenv('LT_PASS');

		$data = array('text' => $text, 'source' => $source, 'target' => $target);
		$curl = curl_init("https://gateway.watsonplatform.net/language-translator/api/v2/translate");

		$options = array(
				CURLOPT_HTTPHEADER => array(
						'content-type: application/json','accept: application/json'
				),
				CURLOPT_USERPWD => $LTuser. ':' . $LTpass,
				CURLOPT_POST => true,
				CURLOPT_POSTFIELDS => json_encode($data),
				CURLOPT_RETURNTRANSFER => true,
		);

		curl_setopt_array($curl, $options);
		$jsonString= curl_exec($curl);
		$json = json_decode($jsonString, true);
		return $json["translations"][0]["translation"];
	}

	function callcvsWebbot($cityCD,$url,$data){

		$username = getenv('CVS_USERNAME');
		$password = getenv('CVS_PASS');

		$curl = curl_init($url);
		$options = array(
				CURLOPT_HTTPHEADER => array(
						'Content-Type: application/json',
				),
				CURLOPT_USERPWD => $username . ':' . $password,
				CURLOPT_POST => true,
				CURLOPT_POSTFIELDS => json_encode($data),
				CURLOPT_RETURNTRANSFER => true,
		);
		curl_setopt_array($curl, $options);
		return curl_exec($curl);
	}


}
