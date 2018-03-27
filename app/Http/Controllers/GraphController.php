<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\Logindata;
use App\Parameter;
use App\User;

class GraphController extends Controller {
	public function index() {
		return view ( 'graph' );
	}
}
