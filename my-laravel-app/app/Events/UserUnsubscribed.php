<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserUnsubscribed {

    use Dispatchable, SerializesModels;

    public string $email;

    public function __construct(string $email) {
        
        $this->email = $email;
    }
}
