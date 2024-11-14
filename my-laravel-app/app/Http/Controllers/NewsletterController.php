<?php

namespace App\Http\Controllers;

use App\Dto\NewsletterSubscribeDto;
use App\Dto\NewsletterUnsubscribeDto;
use App\Service\NewsletterSubscribeService;
use App\Service\NewsletterUnsubscribeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class NewsletterController extends Controller {
    
    // initialization of NewsletterSubscribeService and NewsletterUnsubscribeService
    private NewsletterSubscribeService $subscribeService;
    private NewsletterUnsubscribeService $unsubscribeService;
    
    public function __construct(
        
        NewsletterSubscribeService $subscribeService,
        NewsletterUnsubscribeService $unsubscribeService
        ) {
            $this->subscribeService = $subscribeService;
            $this->unsubscribeService = $unsubscribeService;
    }
    
    // show registration user interface
    public function showRegisterForm() {
        
        return view('newsletter.register');
    }
    
    /**
     * Handles the registration of a user's email for the newsletter.
     *
     * This method creates a DTO (Data Transfer Object) for the email
     * and uses the `execute` method on `subscribeService` to handle
     * the subscription logic. If validation fails, it catches the
     * `ValidationException` and returns errors to the view. If any
     * other error occurs, a generic error message is returned.
     *
     * @param Request $request The HTTP request containing the user's email.
     * @return \Illuminate\Http\RedirectResponse A redirect response with either
     *         a success message or validation/error messages.
     *
     * @throws ValidationException If the email validation fails.
     * @throws \Exception If any other error occurs during registration.
     */
    public function registerEmail(Request $request) {
        
        try {
            
            $subscribeDto = NewsletterSubscribeDto::create($request->get("email"));
            $this->subscribeService->execute($subscribeDto);
            
            return redirect()->back()->with('status', 'Registrazione completata');
            
        } catch (ValidationException $e) {
            
            return redirect()->back()->withErrors($e->errors());
            
        } catch (\Exception $e) {
            
            return redirect()->back()->withErrors(['email' => 'Errore durante la registrazione']);
        }
    }
    
    // show unsubscription user interface
    public function showUnsubscribeForm() {
        
        return view('newsletter.unsubscribe');
    }
    
    /**
     * Handles the unsubscription of a user's email from the newsletter.
     *
     * This method creates a DTO (Data Transfer Object) for the email
     * and invokes the `execute` method on `unsubscribeService` to handle
     * the unsubscription logic. If validation fails, it catches the
     * `ValidationException` and returns the errors to the view. If any
     * other error occurs, a generic error message is returned.
     *
     * @param Request $request The HTTP request containing the user's email.
     * @return \Illuminate\Http\RedirectResponse A redirect response with either
     *         a success message or validation/error messages.
     *
     * @throws ValidationException If the email validation fails.
     * @throws \Exception If any other error occurs during unsubscription.
     */
    public function unsubscribeEmail(Request $request) {
        
        try {
            
            $unsubscribeDto = NewsletterUnsubscribeDto::create($request->get("email"));
            $this->unsubscribeService->execute($unsubscribeDto);
            
            return redirect()->back()->with('status', 'Cancellazione completata');
            
        } catch (ValidationException $e) {
            
            return redirect()->back()->withErrors($e->errors());
            
        } catch (\Exception $e) {
            
            return redirect()->back()->withErrors(['email' => 'Errore durante la cancellazione']);
        }
    }
}


