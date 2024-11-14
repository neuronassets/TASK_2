<?php

namespace App\Dto;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class NewsletterUnsubscribeDto {
    
    public string $email;
    
    /**
     * Private constructor to validate and assign the email address.
     *
     * This constructor validates the provided email address to ensure it is
     * valid and exists in the `mailing` table. If validation fails, a
     * `ValidationException` will be thrown.
     *
     * @param string $email The email address to be validated and assigned.
     * @throws ValidationException If the email is invalid or does not exist in the `mailing` table.
     */
    private function __construct(string $email) {
        
        // validate email in constructor
        $validator = Validator::make(
            ['email' => $email],
            ['email' => 'required|email|exists:mailing,email']
            );
        
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        
        // assign email after validation succeeds
        $this->email = $email;
    }
    
    // factory method to create and validate the instance
    public static function create(string $email): self {
        
        return new self($email);
    }
}
