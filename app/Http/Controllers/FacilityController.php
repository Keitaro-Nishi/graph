<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facility;

class FacilityController
{

	public function index(Request $request)
	{
		$botlogs = Facility::all();
		return view('facility',['facilitys'=>$botlogs]);
	}

	public function delete(Request $request)
	{

		$deleteno = $request->deleteno;
		$deletebotlog = Facility::find($deleteno);
		$deletebotlog->delete();

		return redirect('/facility');
	}

}