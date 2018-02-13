<?php

namespace App\Listeners;

use App\Events\Logined;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
      $user->last_logout_at = Carbon::now();
      $user->save();


    }
}

