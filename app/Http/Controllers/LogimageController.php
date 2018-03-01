<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Logimage;

class LogimageController
{
	public function index(Request $request)
	{
		$cityCD = Auth::user()->citycode;
		if($cityCD = "00000"){
			$logimages = Logimage::all();
		}else{
			$logimages= Logimage::where('citycode', $cityCD)->get();
		}
		return view('logimage',['logimages'=>$logimages]);
	}

	public function delete(Request $request)
	{
		$deleteNo = $request->deleteno;
		//error_log("★★★★★★★");
		//error_log($deleteNo);
		//DB::delete('delete from opinion WHERE id=?',[$deleteNo]);

		$deletelogimage= Logimage::find($deleteNo);
		$deletelogimage->delete();

		return redirect('/logimage');
	}

}
