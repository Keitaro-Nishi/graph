<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Code;

class CodeManageController
{

	public function index(Request $request)
	{
		$cityCD = Auth::user()->citycode;
		$codes= Code::where('citycode', $cityCD)->orderBy('code1', 'ASC')->orderBy('code2', 'ASC')->get();
		$bunrui = Code::where('citycode', $cityCD)->where('code1', (int)0)->orderBy('code2', 'ASC')->get();
		return view('codemanage',['codes'=>$codes,'bunrui'=>$bunrui]);
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
		error_log("★★★★★★★★★★★★★★update_start★★★★★★★★★★★★★★");
		$input = $this->requestall;

		$selcode = $input["selcode"];
		error_log("★★★★★★★★★★★★★★update_start★★★★★★★★★★★★★★".$selcode);
		$cityCD = Auth::user()->citycode;

		if($selcode == ""){
			//新規
			$code = new Code;
			$code->citycode = $cityCD;
			$code->code1 = $input["code1"];
			$code2 = Code::where('citycode', $cityCD)->where('code1', $input["code1"])->max('code2');
			error_log("★★★★★★★★★★★★★★code2★★★★★★★★★★★★★★".$code2);
			$code->code2 = $code2 + 1;
			$code->meisho = $input["meisho"];
			$code->num = $input["num"];
			$code->class1 = $input["class1"];
			$code->class2 = 0;
			$code->save();
		}else{
			//変更
			$code12 = explode(".", $selcode);
			error_log("★★★★★★★★★★★★★★code12★★★★★★★★★★★★★★".$code12[0]."★".$code12[1]);
			$code = Code::where('citycode', $cityCD)->where('code1', $code12[0])->where('code2', $code12[1])->first();
			$code->meisho = $input["meisho"];
			$code->num = $input["num"];
			if($input["code1"] == 0){
				error_log("★★★★★★★★★★★★★★code->class1★★★★★★★★★★★★★★".$code->class1);
				if($code->class1 != $input["class1"]){
					$code->class1 = $input["class1"];
					Code::where('citycode', $cityCD)->where('code1', $code12[1])->update(['class1', $input["class1"]]);
				}
			}
			error_log("★★★★★★★★★★★★★★update_start2★★★★★★★★★★★★★★");
			$code->save();
		}
		return \Response::json(['status' => 'OK']);
	}

	public function delete()
	{
		/*
		$input = $this->requestall;
		User::destroy($input["userids"]);
		return \Response::json(['status' => 'OK']);
		*/
	}

}
