<?php

namespace App\Listeners;

use App\Events\Logined;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
      /*$user = Auth::user();
      $user->last_login_at = Carbon::now();
      $user->save();
      */

    	$user = Auth::user();
    	$date = date_create(Carbon::now());
    	$date = date_format($date, 'Y-m-d-h');
    	$user->last_login_at = $date;
    	$user->save();
    }
}
