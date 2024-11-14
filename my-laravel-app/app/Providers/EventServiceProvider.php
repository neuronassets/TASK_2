<?php

namespace App\Providers;

use App\Events\UserRegistered;
use App\Events\UserUnsubscribed;
use App\Listeners\SubscribeSendEmailListener;
use App\Listeners\SubscribeLogListener;
use App\Listeners\UnsubscribeSendEmailListener;
use App\Listeners\UnsubscribeLogListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {
    
    protected $listen = [
        
        UserRegistered::class => [
            SubscribeSendEmailListener::class,
            SubscribeLogListener::class,
        ],
        
        UserUnsubscribed::class => [
            UnsubscribeSendEmailListener::class,
            UnsubscribeLogListener::class,
        ],
    ];
    
    public function boot() {
        
        parent::boot();
    }
}
