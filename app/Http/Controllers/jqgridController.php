<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class jqgridController extends Controller
{

    public function index()
    {

    	$tests =DB::select('select * from test');
    	//return Response::json($tests);

    	//header("Content-Type: application/json charset=utf-8");
    	//echo json_encode( $json_data);

        return view('jqgrid');
    }
}
