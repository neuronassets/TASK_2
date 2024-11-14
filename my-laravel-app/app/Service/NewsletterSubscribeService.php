<?php

namespace App\Service;

use App\Dto\NewsletterSubscribeDto;
use App\Events\UserRegistered;
use App\Models\Mailing;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class NewsletterSubscribeService {

    /**
     * Executes the process of subscribing a user to the newsletter.
     *
     * This method validates the email from the `NewsletterSubscribeDto`
     * and inserts it into the `mailing` database table if valid. If validation
     * fails, a `ValidationException` is thrown. After successful insertion,
     * it dispatches the `UserRegistered` event.
     *
     * @param NewsletterSubscribeDto $dto Data Transfer Object containing the email to be registered.
     * @return void
     *
     * @throws ValidationException If the email validation fails.
     */
    public function execute(NewsletterSubscribeDto $dto): void {
        
        // validation
        $validator = Validator::make(
            ['email' => $dto->email],
            ['email' => 'required|email']
            );
        
        if ($validator->fails()) {
            throw ValidationException::withMessages(['email' => 'Email non valida']);
        }
        
        // creation new email object and saving into db
        Mailing::create(['email' => $dto->email]);
        
        // run event after registration
        UserRegistered::dispatch($dto->email);
    }
}
