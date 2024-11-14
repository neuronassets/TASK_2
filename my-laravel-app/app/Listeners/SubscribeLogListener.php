<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Support\Facades\Log;

class SubscribeLogListener {
    
    public function handle(UserRegistered $event) {
        
        Log::info("Registrata la mail {$event->email} con successo.");
    }
}
