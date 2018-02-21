<?php

namespace App\Listeners;

use App\Events\Logouted;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Logindata;

/**
 * ログアウト完了時に発火するイベントをキャッチするリスナークラス
 * Class LastLoginListener
 * @package App\Listeners
 */
class LastLogoutListener
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
    public function handle(Logouted $event)
    {

      $user = Auth::user();
      $logindata = new Logindata;
      $logindata->userid = $user->userid;
      $logindata->classification = 'ログアウト';
      $logindata->time = Carbon::now();

      $logindata->save();

    }
}