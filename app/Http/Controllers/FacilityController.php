<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facility;

class FacilityController
{

	public function index(Request $request)
	{
		$facilitys= Facility::all();
		return view('facility',['facilitys'=>$facilitys]);
	}
/*
	public function update(Request $request)
	{



		return redirect('/facility');
	}
*/
	public function delete(Request $request)
	{

		$deleteid = $request->deletecode;
		$deletefacility = Facility::find($deleteid);
		$deletefacility->delete();

		return redirect('/facility');
	}

}