<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Service\SendMailService;
use App\Dto\SendMailDto;

class SubscribeSendEmailListener {
    
    private SendMailService $sendMailService;

    public function __construct(SendMailService $sendMailService) {
        
        $this->sendMailService = $sendMailService;
    }
    
    /**
     * Handles the `UserRegistered` event by sending a confirmation email.
     *
     * This method is triggered when a user successfully registers for the newsletter.
     * It prepares a `SendMailDto` with the user's email and sends a confirmation
     * email via the `SendMailService`.
     *
     * @param UserRegistered $event The event containing the user's email address.
     * @return void
     */
    public function handle(UserRegistered $event) {
        
        $sendMailDto = SendMailDto::create(
            $event->email,
            'Grazie per esserti registrato alla newsletter',
            'Conferma Registrazione'
        );

        $this->sendMailService->execute($sendMailDto);
    }
}
