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

	public function insert(Request $request)
	{



		return redirect('/facility');
	}

	public function delete(Request $request)
	{

		$deleteno = $request->deleteno;
		$deletebotlog = Facility::find($deleteno);
		$deletebotlog->delete();

		return redirect('/facility');
	}

}