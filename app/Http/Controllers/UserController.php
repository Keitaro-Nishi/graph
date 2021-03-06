<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Code;
use App\Parameter;

class UserController
{
	private $requestall;

	public function index(Request $request)
	{
		$cityCD = Auth::user()->citycode;

		if($cityCD == "00000"){
			$users = User::select()->where('users.role', '<' ,(int)2)->leftJoin('code', function ($join) {
				$organizationCD = (int)12;
				$join->on('users.citycode', '=', 'code.citycode')->where('code.code1', $organizationCD);
				$join->on('users.organization', '=', 'code.code2');
			})
			->get();
			$citycodes = Parameter::select('citycode','cityname')->orderBy('citycode', 'ASC')->get();
		}else{
			//$users= User::where('citycode', $cityCD)->get();
			$users = User::select()->where('users.citycode', $cityCD)->leftJoin('code', function ($join) {
				$organizationCD = (int)12;
				$join->on('users.citycode', '=', 'code.citycode')->where('code.code1', $organizationCD);
				$join->on('users.organization', '=', 'code.code2');
			})
			->get();
			$citycodes = "";
		}
		$organizations= Code::where('citycode', $cityCD)->where('code1', 12)->orderBy('code2', 'ASC')->get();
		$intpass = Parameter::select('intpasscalss','intpass')->where('citycode', $cityCD)->first();
		return view('users',['users'=>$users,'organizations'=>$organizations,'intpass'=>$intpass,'citycodes'=>$citycodes]);
	}

	public  function request(){
		$this->requestall = \Request::all();
		if($this->requestall["param"] == "update"){
			return $this->update();
		}elseif ($this->requestall["param"] == "delete"){
			return $this->delete();
		}else{
			return \Response::json(['status' => 'NG']);
		}
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
