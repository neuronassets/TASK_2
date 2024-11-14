<?php

namespace App\Listeners;

use App\Events\UserUnsubscribed;
use Illuminate\Support\Facades\Log;

class UnsubscribeLogListener {
    
    public function handle(UserUnsubscribed $event) {
        
        Log::info("Cancellata la mail {$event->email} con successo.");
    }
}
