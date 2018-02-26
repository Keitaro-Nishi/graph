<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Carbon\Carbon;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
    	// ログイン時にイベントを発行
    	'App\Events\Logined' => [
    	// 最終ログインを記録するリスナー
    	'App\Listeners\LastLoginListener',
    	],
    	// ログアウト時にイベントを発行
    	'App\Events\Logouted' => [
    	// 最終ログアウトを記録するリスナー
    	'App\Listeners\LastLogoutListener',
    	]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */

    public function boot()
    {
        parent::boot();

        //
    }


}
