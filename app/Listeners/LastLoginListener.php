<?php

namespace App\Listeners;

use App\Events\Logined;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Logindata;

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
		$logindata = new Logindata;

		$logindata->citycode = $user->citycode;
		$logindata->userid = $user->userid;
		$logindata->classification = 'ログイン';
		$logindata->time = Carbon::now();

		$logindata->save();

	}
}