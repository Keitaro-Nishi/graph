<?php

namespace app\Libs;

use Illuminate\Http\Request;


class Watson{

	public function callWatson($url,$username,$password,$data,$cityCD){
		error_log($cityCD);
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


	function callWatson2($url,$username,$password,$cityCD){
		error_log($cityCD);
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


	function callWatson3($url,$username,$password,$cityCD){
		error_log($cityCD);
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

}
