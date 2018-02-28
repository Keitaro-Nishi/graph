<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Facility;

class FacilityController
{

	public function index(Request $request)
	{
		$cityCD = Auth::user()->citycode;
		if($cityCD = "00000"){
			$facilities = Facility::all();
		}else{
			$facilities= Facility::where('citycode', $cityCD)->get();
		}
		return view('facility',['facilities'=>$facilities]);
	}

	public function update()
	{


		return redirect ( '/facility' );
	}

	public function delete(Request $request)
	{

		$deleteid = $request->deleteid;
		$deletefacility = Facility::find($deleteid);
		$deletefacility->delete();

		return redirect('/facility');
	}

}