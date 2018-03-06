<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
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
			$code1 = $input["code1"];
			$code2max = Code::where('citycode', $cityCD)->where('code1', $code1)->max('code2');
			error_log("★★★★★★★★★★★★★★code2★★★★★★★★★★★★★★".$code2max);
			$code2 = $code2max + 1;
			$meisho = $input["meisho"];
			$num = $input["num"];
			$class1 = $input["class1"];
			$class2 = "0";
			//code->save();
			error_log("★★★★★★★★★★★★★★code2★★★★★★★★★★★★★★".$code2);
			$result = DB::table ( 'code' )->insert ( [
					'citycode' => $cityCD,
					'code1' => $code1,
					'code2' => $code2,
					'meisho' => $meisho,
					'num' => $num,
					'class1' => $class1,
					'class2' => $class2
					] );
		}else{
			//変更
			$code12 = explode(".", $selcode);
			error_log("★★★★★★★★★★★★★★code12★★★★★★★★★★★★★★".$code12[0]."★".$code12[1]);
			$code = Code::where('citycode', $cityCD)->where('code1', $code12[0])->where('code2', $code12[1])->first();
			$meisho = $input["meisho"];
			$num = $input["num"];
			$class1 = $code->class1;
			if($input["code1"] == 0){
				error_log("★★★★★★★★★★★★★★code->class1★★★★★★★★★★★★★★".$class1);
				if($class1 != $input["class1"]){
					$class1 = $input["class1"];
					Code::where('citycode', $cityCD)->where('code1', $code12[1])->update(['class1' => $class1]);
				}
			}
			error_log("★★★★★★★★★★★★★★update_start2★★★★★★★★★★★★★★");
			//$code->save();
			Code::where('citycode', $cityCD)->where('code1', $code12[0])->where('code2', $code12[1])->update(['meisho' => $meisho , 'num' => $num , 'class1' => $class1]);

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
