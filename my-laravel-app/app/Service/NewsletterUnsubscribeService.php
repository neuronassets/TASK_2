<?php

namespace App\Service;

use App\Dto\NewsletterUnsubscribeDto;
use App\Events\UserUnsubscribed;
use App\Models\Mailing;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class NewsletterUnsubscribeService {
    
    /**
     * Executes the process of unsubscribing a user from the newsletter.
     *
     * This method validates the email from the `NewsletterUnsubscribeDto`
     * and deletes it from the `mailing` database table if valid. If validation
     * fails, a `ValidationException` is thrown. After successful unsubscription,
     * it dispatches the `UserUnsubscribed` event.
     *
     * @param NewsletterUnsubscribeDto $dto Data Transfer Object containing the email to be unsubscribed.
     * @return void
     *
     * @throws ValidationException If the email validation fails.
     */
    public function execute(NewsletterUnsubscribeDto $dto): void {
        
        // validation
        $validator = Validator::make(
            ['email' => $dto->email],
            ['email' => 'required|email']
            );
        
        if ($validator->fails()) {
            throw ValidationException::withMessages(['email' => 'Email non valida']);
        }

        // delete the email object from db
        Mailing::where('email', $dto->email)->delete();

        // run event after deletion
        UserUnsubscribed::dispatch($dto->email);
    }
}
