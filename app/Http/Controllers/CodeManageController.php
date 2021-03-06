<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Code;
use App\Parameter;

class CodeManageController
{

	public function index(Request $request)
	{
		$cityCD = Auth::user()->citycode;
		if(Auth::user()->role == (int)0){
			$codes= Code::orderBy('citycode', 'ASC')->orderBy('code1', 'ASC')->orderBy('code2', 'ASC')->get();
			$bunrui = Code::where('citycode', '00000')->where('code1', (int)0)->orderBy('code2', 'ASC')->get();
			$citycodes = Parameter::select('citycode','cityname')->orderBy('citycode', 'ASC')->get();
		}else{
			$codes= Code::where('citycode', $cityCD)->where('class2', '<>', '1')->orderBy('code1', 'ASC')->orderBy('code2', 'ASC')->get();
			$bunrui = Code::where('citycode', '00000')->where('code1', (int)0)->where('code2', '>' ,(int)0)->where('class2', '<>', '1')->orderBy('code2', 'ASC')->get();
			$citycodes = "";
		}

		return view('codemanage',['codes'=>$codes,'bunrui'=>$bunrui,'citycodes'=>$citycodes]);
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
		$selcode = $input["selcode"];
		$cityCD = Auth::user()->citycode;
		if($input["citycode"] != ""){
			$cityCD = $input["citycode"];
		}

		if($selcode == ""){
			//新規
			$code1 = $input["code1"];
			$code2max = Code::where('citycode', $cityCD)->where('code1', $code1)->max('code2');
			$code2 = $code2max + 1;
			$meisho = $input["meisho"];
			$num = $input["num"];
			$class1 = $input["class1"];
			$class2 = $input["class2"];
			$result = DB::table('code')->insert([
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
			$code = Code::where('citycode', $cityCD)->where('code1', $code12[0])->where('code2', $code12[1])->first();
			$meisho = $input["meisho"];
			$num = $input["num"];
			$class1 = $code->class1;
			$class2 = $input["class2"];
			if($input["code1"] == 0){
				if($class1 != $input["class1"]){
					$class1 = $input["class1"];
					DB::table('code')->where('citycode', $cityCD)->where('code1', $code12[1])->update(['class1' => $class1]);
				}
			}
			DB::table('code')->where('citycode', $cityCD)->where('code1', $code12[0])->where('code2', $code12[1])->update(['meisho' => $meisho , 'num' => $num , 'class1' => $class1, 'class2' => $class2]);

		}
		return \Response::json(['status' => 'OK']);
	}

	public function delete()
	{
		$input = $this->requestall;
		$codes = $input["codes"];
		$cityCD = Auth::user ()->citycode;
		if($input["citycode"] != ""){
			$cityCD = $input["citycode"];
		}
		foreach ( $codes as $code ) {
			$code12 = explode(".", $code);
			DB::table('code')->where('citycode', $cityCD)->where('code1', $code12[0])->where('code2', $code12[1])->delete();
		}
		return \Response::json(['status' => 'OK']);
	}

}
