<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Userinfo;
use App\Code;

class LinepushController
{
	private $requestall;

	public function index(Request $request)
	{
		$cityCD = Auth::user()->citycode;

		$codes = array();

		for ($i = 1; $i <= 10; $i++) {
			$count = Code::where('citycode', $cityCD)->where('code1', $i)->where('code2', '>', 0)->count();
			if($count > 0){
				$records = Code::select('code1','code2','meisho')->where('citycode', $cityCD)->where('code1', $i)->orderBy('code2', 'ASC')->get();
				array_push($codes, json_decode($records,true));
			}
		}

		$hitcount = Userinfo::where('citycode', $cityCD)->where('sender', (int)1)->count();
		return view('linepush',['codes'=>$codes,'hitcount'=>$hitcount]);
	}

	public  function request(){
		$this->requestall = \Request::all();
		if($this->requestall["param"] == "search"){
			return $this->search();
		}elseif ($this->requestall["param"] == "delete"){
			return $this->delete();
		}else{
			return \Response::json(['status' => 'NG']);
		}
	}

	public function search(){
		$input = $this->requestall;
		$cityCD = Auth::user()->citycode;
		$q = Userinfo::query();
		$q->where('citycode', $cityCD);
		$q->where('sender', (int)1);
		switch ($input["info"]) {
			//全て
			case 0:

				break;
			//属性登録あり
			case 1:
				$q->where('updkbn', '1');
				if($input["agek"] != 999){
					$q->where('age', '>=', $input["agek"]);
					if($input["agem"] != 999){
						$q->where('age', '<=', $input["agem"]);
					}
				}
				if($input["sex"] > 0){
					$q->where('sex', $input["sex"]);
				}
				for ($i = 1; $i <= 10; $i++) {
					if($input["option"][$i-1] > 0){
						$q->where('param'.$i, $input["option"][$i-1]);
					}
				}
				break;
			//属性登録なし
			case 2:
				$q->where('updkbn', '0');
				break;
		}

		$hitcount = $q->count();
		return \Response::json(['hitcount' => $hitcount]);
	}

	public function update()
	{
		$input = $this->requestall;

		$rules = [ 'citycode' => 'required|string'];

		if($input["updateKbn"] == "true"){
			$rules = $rules + ['userid' => 'required|string|max:255'];
		}else{
			$rules = $rules + ['userid' => 'required|string|max:255|unique:users'];
		}

		$rules = $rules + [
			'username' => 'required|string|max:255',
			'organization' => 'required|string|max:255'
		];

		if($input["passreset"] == "true"){
			$rules = $rules + ['password' => 'required|string|min:6|confirmed'];
		}

		$validator = Validator::make($input,$rules);

		if($validator->fails())
		{
			return $validator->errors();
		}

		//$user = new User;
		$user = User::firstOrNew(['userid' => $input["userid"]]);
		$cityCD = Auth::user()->citycode;
		//市町村コード
		if($cityCD == "00000"){
			$user->citycode= $input["citycode"];
		}else{
			$user->citycode= $cityCD;
		}
		//ユーザーＩＤ
		$user->userid= $input["userid"];
		//名前
		$user->name= $input["username"];
		//権限
		if($cityCD == "00000"){
			$user->role= (int)1;
		}else{
			$user->role= (int)2;
		}
		//所属
		$user->organization= $input["organization"];
		//パスワード
		if($input["passreset"] == "true"){
			$user->password= bcrypt($input["password"]);
		}
		//email
		$user->email= "";
		//予備
		$user->reserve= "";

		$result = $user->save();

		return \Response::json(['status' => 'OK']);
	}

	public function delete()
	{
		$input = $this->requestall;
		User::destroy($input["userids"]);
		/*
		foreach ($input["userids"] as $userid) {
			error_log("★★★★★★★★★★★★★delete2★★★★★★★★★★★★★★★".$userid);
		}
		*/
		return \Response::json(['status' => 'OK']);
	}

}

