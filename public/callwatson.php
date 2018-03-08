<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

$workspace_id = getenv('CVS_WORKSPASE_ID');
$username = getenv('CVS_USERNAME');
$password = getenv('CVS_PASS');

$param = $_POST['param'];
$g1meisho= $_POST['g1meisho'];
$g2meisho= $_POST['g2meisho'];
$sword= $_POST['sword'];

error_log("☆☆☆☆☆☆☆");
error_log("g1meisho:".$g1meisho." g2meisho:".$g2meisho." param:".$param." sword:".$sword);
error_log("届きました");

$data = "";

switch($param) {
	case 'intentSearch':
		intentSearch();
		break;
	case 'intentUpdate':
		intentUpdate();
		break;
	case 'intentDelete':
		intentDelete();
		break;
	case 'entitySearch':
		entitySearch();
		break;
	case 'entityUpdate':
		entityUpdate();
		break;
	case 'entityDelete':
		entityDelete();
		break;
	default:
		continue;
}

function intentSearch(){
	global $url,$g1meisho,$workspace_id;
	$url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/".$workspace_id."/intents/".$g1meisho."/examples?version=2017-05-26&export=true";
	$jsonString = callWatson2();
	$json = json_decode($jsonString, true);
	$arr = array();
	foreach ($json["examples"] as $value){
		array_push($arr,$value["text"]);
	}
	echo json_encode($arr);
}

function intentUpdate(){
	global $url,$g1meisho,$workspace_id,$sword,$data;
	$url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/".$workspace_id."/intents/".$g1meisho."/examples?version=2017-05-26";
	$data = array("text" => $sword);
	$jsonString = callWatson();
	$json = json_decode($jsonString, true);
	if($json["text"] == $sword){
		echo json_encode("OK");
	}else{
		echo json_encode("NG");
	}
}

function intentDelete(){
	global $url,$g1meisho,$workspace_id,$sword,$data;
	$url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/".$workspace_id."/intents/".$g1meisho."/examples/".urlencode($sword)."?version=2017-05-26";
	$result = callWatson3();
	error_log($result);
	if($result == "200"){
		echo json_encode("OK");
	}else{
		echo json_encode("NG");
	}
}

function entitySearch(){
	global $url,$g1meisho,$g2meisho,$workspace_id;
	$url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/".$workspace_id."/entities/".$g1meisho."/values/".urlencode($g2meisho)."/synonyms?version=2017-05-26";
	$jsonString = callWatson2();
	$json = json_decode($jsonString, true);
	$arr = array();
	foreach ($json["synonyms"] as $value){
		array_push($arr,$value["synonym"]);
	}
	echo json_encode($arr);
}

function entityUpdate(){
	global $url,$g1meisho,$g2meisho,$workspace_id,$sword,$data;
	$url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/".$workspace_id."/entities/".$g1meisho."/values/".urlencode($g2meisho)."/synonyms?version=2017-05-26";
	$data = array("synonym" => $sword);
	$jsonString = callWatson();
	$json = json_decode($jsonString, true);
	if($json["synonym"] == $sword){
		echo json_encode("OK");
	}else{
		echo json_encode("NG");
	}
}

function entityDelete(){
	global $url,$g1meisho,$g2meisho,$workspace_id,$sword,$data;
	$url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/".$workspace_id."/entities/".$g1meisho."/values/".urlencode($g2meisho)."/synonyms/".urlencode($sword)."?version=2017-05-26";
	$result = callWatson3();
	error_log($result);
	if($result == "200"){
		echo json_encode("OK");
	}else{
		echo json_encode("NG");
	}
}

function callWatson(){
	global $curl, $url, $username, $password, $data, $options;
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

function callWatson2(){
	global $curl, $url, $username, $password, $data, $options;
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
function callWatson3(){
	global $curl, $url, $username, $password, $data, $options;
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
?>
