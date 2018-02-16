<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class jqgridController extends Controller
{

    public function index()
    {

    	//$tests =DB::select('select * from test');
    	//$id =DB::select('select id from test');
    	//$name =DB::select('select name from test');
    	$json_data = array();
    	$price =DB::select('select price from test');

    	$json_data[0] = $price;

    	header("Content-Type: application/json charset=utf-8");
    	echo json_encode( $json_data);



        return view('jqgrid');
    }
}
