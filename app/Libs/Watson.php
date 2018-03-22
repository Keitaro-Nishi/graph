<?php

namespace app\Libs;

use Illuminate\Http\Request;


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
