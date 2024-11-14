<?php

namespace App\Dto;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class SendMailDto {
    
    public string $email;
    public string $messageBody;
    public string $subject;
    
    /**
     * Constructor to validate the email format and to ensure it's
     * a valid email address. If the email is invalid, a `ValidationException`
     * will be thrown.
     *
     * @param string $email The email address of the recipient.
     * @param string $messageBody The body/content of the email.
     * @param string $subject The subject of the email.
     * @throws ValidationException If the email format is invalid.
     */
     private function __construct(string $email, string $messageBody, string $subject) {
        
        $this->email = $email;
        $this->messageBody = $messageBody;
        $this->subject = $subject;
        
        // Validate the email format and required fields
        $validator = Validator::make(
            ['email' => $this->email],
            ['email' => 'required|email']
            );
        
        // throw exception if validation fails
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
    
    // method to instantiate and return a new SendMailDto
    public static function create(string $email, string $messageBody, string $subject): self {
        
        return new self($email, $messageBody, $subject);
    }
}
