<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class jqgridController extends Controller
{

    public function index()
    {

    	//$tests =DB::select('select * from test');
    	$id =DB::select('select id from test');
    	$name =DB::select('select name from test');
    	$price =DB::select('select price from test');
    	header('Content-Type: application/json');
    	echo json_encode( $tests );

        return view('jqgrid');
    }
}
