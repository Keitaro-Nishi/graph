<?php

namespace App\Listeners;

use App\Events\Logined;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Logindata;
use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;

/**
 * ログイン完了時に発火するイベントをキャッチするリスナークラス
 * Class LastLoginListener
 * @package App\Listeners
 */
class LastLoginListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Logined  $event
     * @return void
     */
    public function handle(Logined $event)
    {

    /*
    $user = Auth::user();
    $userid = $user->userid;
    $last_login_at = Carbon::now();

    DB::insert('insert into logindata (userid,last_login_at) values (?,?)', [$userid,$last_login_at]);
	*/
	    //function store(Request $request)
	    //{
	    $user = Auth::user();
	    $logindata = new Logindata;
	    $logindata->userid = $user->userid;
	    $logindata->last_login_at = Carbon::now();

	    $logindata->save();
	    //}

    }
}
