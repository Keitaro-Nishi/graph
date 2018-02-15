<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class jqgridController extends Controller
{

    public function index()
    {

    	$tests =DB::select('select * from test');
    	header('Content-Type: application/json');
    	echo json_encode( $tests );
    	exit;
        return view('jqgrid');
    }
}
