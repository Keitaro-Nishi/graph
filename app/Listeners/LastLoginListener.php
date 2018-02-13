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

      $user = Auth::user();
      $user->last_login_at = Carbon::now()->format('Y-m-d');
      $user->save();

		/*
      $user = Auth::user();
      $day = new DateTime(Carbon::now());
      $user->last_login_at = $day->format('Y年m月d日 H時i分s秒');
      $user->save();
      */

    }
}
