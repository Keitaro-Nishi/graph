<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Logimage;

class LogimageController
{
	public function index(Request $request)
	{

		$logimages = Logimage::all();
		$php_json = json_encode($logimages);

		//return view('logimage',['logimage'=>$logimage]);
		return view('logimage')->with('logimages', $logimages);

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
