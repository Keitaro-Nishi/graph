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
    	header("Content-Type: application/json charset=utf-8");
    	echo json_encode( $id );
    	echo json_encode( $name );
    	echo json_encode( $price );

        return view('jqgrid');
    }
}
