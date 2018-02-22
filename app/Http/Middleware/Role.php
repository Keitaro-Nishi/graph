<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Role
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{

		if (Auth::user()->role == (int)2 ) {
			return redirect('home');
		}
		else (Auth::user()->role == null ); {
			return redirect('login');
		}

		return $next($request);
	}
}
