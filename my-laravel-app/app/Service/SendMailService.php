<?php

namespace App\Listeners;

use App\Events\UserUnsubscribed;
use App\Service\SendMailService;
use App\Dto\SendMailDto;

class UnsubscribeSendEmailListener {
    
    private SendMailService $sendMailService;
    
    public function __construct(SendMailService $sendMailService) {
        
        $this->sendMailService = $sendMailService;
    }
    
    /**
     * Handles the `UserUnsubscribed` event by sending a confirmation email.
     *
     * This method is triggered when a user successfully unsubscribes from the newsletter.
     * It prepares a `SendMailDto` with the user's email and sends a confirmation
     * email via the `SendMailService`.
     *
     * @param UserUnsubscribed $event The event containing the user's email address.
     * @return void
     */
    public function handle(UserUnsubscribed $event) {
        
        $sendMailDto = SendMailDto::create(
            $event->email,
            'Grazie per essere stato con noi, ci mancherai',
            'Cancellazione Confermata'
            );
        
        $this->sendMailService->execute($sendMailDto);
    }
}
