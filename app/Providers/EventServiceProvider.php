<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Carbon\Carbon;
use App\User;

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
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    /*
    public function boot()
    {
        parent::boot();

        //
    //}*/

    public function boot(DispatcherContract $events)
    {
    	parent::boot($events);

    	//追加↓
    	$events->listen('auth.login', function ($user)
    	{
    		$user->last_login_at = Carbon::now();
    		$user->save();
    	});
    	//追加↑
    }
}
