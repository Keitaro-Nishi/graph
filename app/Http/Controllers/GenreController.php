<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Libs\Watson;


class GenreController
{
	public function index(Request $request)
	{

		$Authrole = Auth::user()->role;
		$cityCD = Auth::user()->citycode;
		$genrelist= array();
		$genrelists= array();

			$genres= Genre::where('citycode', $cityCD)->orderBy('gid1', 'ASC')->orderBy('gid2', 'ASC')->get();
			//$genregid1 = DB::table('genre')->select('gid1')->where('citycode', $cityCD)->get();
			$genregid1 = Genre::get(['gid1'])->where('citycode', $cityCD);
			$j1values = Genre::where('citycode', $cityCD)->where('bunrui', 1)->get();

			foreach ($genres as $genre) {
				$citycode = $genre->citycode;
				$bunrui = $genre->bunrui;
				$daibunrui;
				$shoubunrui;
				$gid1 = $genre->gid1;
				$gid2 = $genre->gid2;
				$meisho = $genre->meisho;


				if($bunrui == 1){
					$daibunrui = $meisho;
					$shoubunrui = '-';
				}

				if($bunrui == 2){
					$bunruidata= DB::table('genre')->select('meisho')->where('citycode',$cityCD)->where('bunrui',1)->where('gid1',$gid1)->first();
					$shoubunrui = $meisho;
					$daibunrui= $bunruidata->meisho;
				}

				$genrelist= [
						'citycode'=>$citycode,
						'bunrui'=>$bunrui,
						'daibunrui'=>$daibunrui,
						'shoubunrui'=>$shoubunrui,
						'gid1'=>$gid1,
						'gid2'=>$gid2,
				];

				array_push($genrelists, $genrelist);
			}

		return view('genre',compact('genrelists','j1values'));
	}

	public  function request(){
		$this->requestall = \Request::all();
		if ($this->requestall["param"] == "delete"){
			return $this->delete();
		}elseif ($this->requestall["param"] == "update"){
			return $this->update();
		}else{
			return \Response::json(['status' => 'NG']);
		}
	}


	public function delete()
	{

		$workspace_id = getenv('CVS_WORKSPASE_ID');
		$username = getenv('CVS_USERNAME');
		$password = getenv('CVS_PASS');

		$input = $this->requestall;
		$idsdata = $input["ids"];
		$cityCD = Auth::user()->citycode;
		$watson = new Watson;

		foreach ($idsdata as $iddata) {
			$aos = explode(".", $iddata);
			$gid1 = $aos[0];
			$gid2 = $aos[1];

			$g2meishodata = DB::table('genre')->select('meisho')->where('citycode',$cityCD)->where('gid1',$gid1)->where('gid2',$gid2)->first();
			$g2meisho = $g2meishodata->meisho;

			if($gid2 == 0){
				$gid2datas = DB::table('genre')->select('gid2')->where('citycode',$cityCD)->where('gid1',$gid1)->get();

				//CVS削除
				//dialog_node
				$url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/".$workspace_id."/dialog_nodes/node_".$gid1."?version=2017-05-26";
				$watson->callWatson4($url,$username,$password,$cityCD);

				foreach($gid2datas as $gid2data){
					$g2 = $gid2data->gid2;
					$url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/".$workspace_id."/dialog_nodes/".$gid1.".".$g2."?version=2017-05-26";
					$watson->callWatson4($url,$username,$password,$cityCD);
				}

				//Intents
				$url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/".$workspace_id."/intents/".$gid1."?version=2017-05-26";
				$watson->callWatson4($url,$username,$password,$cityCD);

				//ENTITIES
				$url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/".$workspace_id."/entities/".$gid1."?version=2017-05-26";
				$watson->callWatson4($url,$username,$password,$cityCD);

				//DB::table('genre')->where('citycode',$cityCD)->where('gid1',$gid1)->delete();
				Genre::where('citycode',$cityCD)->where('gid1',$gid1)->delete();

			}else{

				//DB::table('genre')->where('citycode',$cityCD)->where('gid1',$gid1)->where('gid2',$gid2)->delete();
				Genre::where('citycode',$cityCD)->where('gid1',$gid1)->where('gid2',$gid2)->delete();

				//CVS削除
				$url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/".$workspace_id."/entities/".$gid1."/values/".urlencode($g2meisho)."?version=2017-05-26";
				$watson->callWatson4($url,$username,$password,$cityCD);

				$url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/".$workspace_id."/dialog_nodes/".$gid1.".".$gid2."?version=2017-05-26";
				$watson->callWatson4($url,$username,$password,$cityCD);
			}
		}

		return \Response::json(['status' => 'OK']);
	}


	public function update()
	{
		$workspace_id = getenv('CVS_WORKSPASE_ID');
		$username = getenv('CVS_USERNAME');
		$password = getenv('CVS_PASS');

		$input = $this->requestall;
		$uiKbn = $input["uiKbn"];
		$bunrui = $input["bunrui"];
		$meisho = $input["meisho"];
		$gid1 = $input["gid1"];
		$gid2 = $input["gid2"];
		$g1meisho = $input["g1meisho"];
		$meishoOld = $input["meishoOld"];
		$cityCD = Auth::user()->citycode;
		$watson = new Watson;

		if($uiKbn == 1){
			DB::table('genre')->where('citycode',$cityCD)->where('gid1',$gid1)->where('gid2',$gid2)->update(['meisho' => $meisho]);

			if($gid2 == 0){
				$result = DB::table('genre')->select('gid2')->select('meisho')->where('gid1',$gid1)->get();
				//大分類
				//CVSデータ修正
				//Intents
				$url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/".$workspace_id."/intents/".$gid1."?version=2017-05-26";
				$data = array("description" => $meisho);
				$watson->callWatson($url,$username,$password,$data,$cityCD);
			}else{
				//小分類
				//CVSデータ修正
				//ENTITIES
				$url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/".$workspace_id."/entities/".$gid1."/values/".urlencode($meishoOld)."?version=2017-05-26";
				$data = array("value" => $meisho);
				$watson->callWatson($url,$username,$password,$data,$cityCD);

				//DIALOG
				$url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/".$workspace_id."/dialog_nodes/".$gid1.".".$gid2."?version=2017-05-26";
				$data = array("conditions" => "@".$gid1.":".$meisho);
				$watson->callWatson($url,$username,$password,$data,$cityCD);
			}
		}else{
			if($bunrui == 1){
				//大分類
				$gid1data= DB::table('genre')->select('gid1')->orderBy('gid1', 'DESC')->first();

				if ($gid1data->gid1 ==null){
					$gid1 = 1;
				}else{
					$gid1 = $gid1data->gid1 + 1;
				}

				DB::table('genre')->insert(['citycode'=> $cityCD,'bunrui' =>$bunrui, 'gid1' => $gid1,'gid2' =>0,'gid3' =>0,'meisho' =>$meisho]);

				//CVSデータ作成
				//Intents
				$url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/".$workspace_id."/intents?version=2017-05-26";
				$data = array("intent" => (string)$gid1,"description" => $meisho);
				$watson->callWatson($url,$username,$password,$data,$cityCD);

				//ENTITIES
				$url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/".$workspace_id."/entities?version=2017-05-26";
				$data = array("entity" => (string)$gid1);
				$watson->callWatson($url,$username,$password,$data,$cityCD);

				//dialog_node
				$previous_sibling = "";
				$bgid1 = $gid1 - 1;
				$nodevalue = $bgid1.".0";

				//全てのLISTから１つ前のダイアログを探す
				$url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/".$workspace_id."/dialog_nodes/?version=2017-05-26";
				$jsonString = $watson->callWatson2($url,$username,$password,$cityCD);
				$json = json_decode($jsonString, true);
				foreach ($json["dialog_nodes"] as $value){

					if($value["output"]["text"]["values"][0] == $nodevalue){
						$previous_sibling = $value["dialog_node"];
						break;
					}
				}
				$url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/".$workspace_id."/dialog_nodes/?version=2017-05-26";
				$data = array("dialog_node" => $gid1.".".$gid2,"title" => "entity".$gid1,"conditions" => "@".$gid1,"previous_sibling" => "ようこそ","metadata" => array("_customization" => array("mcr" => true)));
				$watson->callWatson($url,$username,$password,$data,$cityCD);
				if($previous_sibling == ""){
					$previous_sibling = $gid1.".".$gid2;
				}
				$url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/".$workspace_id."/dialog_nodes/?version=2017-05-26";
				$data = array("dialog_node" => "node_".$gid1,"title" => "intent".$gid1,"conditions" => "#".$gid1,"previous_sibling" => $previous_sibling,"output" => array("text" => array("values" => array($gid1.".".$gid2))));
				$watson->callWatson($url,$username,$password,$data,$cityCD);


			}else{
				//小分類
				$gid2data= DB::table('genre')->select('gid2')->where('gid1',$gid1)->orderBy('gid2', 'DESC')->first();
				$gid2 = $gid2data->gid2 + 1;

				DB::table('genre')->insert(['citycode'=> $cityCD,'bunrui' => $bunrui,'gid1' => $gid1,'gid2' => $gid2,'gid3' =>0,'meisho' => $meisho]);

				//CVSデータ作成
				//ENTITIES
				$url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/".$workspace_id."/entities/".$gid1."/values?version=2017-05-26";
				$data = array("value" => $meisho);
				$watson->callWatson($url,$username,$password,$data,$cityCD);

				//上記で取得したdialog_nodeをparentに設定して新規ノードを作成
				$url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/".$workspace_id."/dialog_nodes/?version=2017-05-26";
				$data = array("dialog_node" => $gid1.".".$gid2,"type" => "response_condition","parent" =>  $gid1.".0","conditions" => "@".$gid1.":".$meisho,"output" => array("text" => array("values" => array($gid1.".".$gid2))));
				$watson->callWatson($url,$username,$password,$data,$cityCD);
			}
		}
		return \Response::json(['status' => 'OK']);

	}


}
