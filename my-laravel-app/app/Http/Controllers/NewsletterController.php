<?php

namespace App\Http\Controllers;

use App\Models\Mailing;
use Carbon\Exceptions\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller {
    
    // show registration user interface
    public function showRegisterForm() {
        
        return view('newsletter.register');
    }
    
    // user input management
    public function registerEmail(Request $request) {
        
        // 'required' checks not empty, 'email' checks format, 'unique' ensures that the email address is unique
        $request->validate(['email' => 'required|email|unique:mailing,email']);
        
        try {
        
            // method fakeRegisterApi always returns true
            if (!$this->fakeRegisterApi($request->email)) {
            
                // show message of failed registration
                return redirect()->back()->withErrors(['email' => 'Errore durante la registrazione']);
            }
        
            // creation new email object and saving into db
            Mailing::create(['email' => $request->email]);
        
            // send confirmation email
            Mail::raw('Grazie per esserti registrato alla newsletter', function ($message) use ($request) {
            
                $message->to($request->email)->subject('Conferma Registrazione');
            });
            
            // log registration
            Log::info("Registrata la mail {$request->email} con successo");
            
            // show message of successful registration
            return redirect()->back()->with('status', 'Registrazione completata');
        
        } catch (Exception $e) {
            
            // log error
            Log::error("Errore durante la registrazione della mail {$request->email}: " . $e->getMessage());
            
            // redirect back error message
            return redirect()->back()->withErrors(['email' => 'Errore durante la registrazione']);
        }
    }
    
    // show unsubscription user interface
    public function showUnsubscribeForm() {
        
        return view('newsletter.unsubscribe');
    }
    
    // user input management
    public function unsubscribeEmail(Request $request) {
        
        // 'required' checks not empty, 'email' checks format, 'exists' ensures that the email address exists
        $request->validate(['email' => 'required|email|exists:mailing,email']);
        
        try {
        
            // method fakeUnregisterApi always returns true
            if (!$this->fakeUnregisterApi($request->email)) {
            
                // show message of failed unsubscription
                return redirect()->back()->withErrors(['email' => 'Errore durante la cancellazione']);
            }
        
            // delete the email object from db
            Mailing::where('email', $request->email)->delete();
        
            // send confirmation email
            Mail::raw('Grazie per essere stato con noi, ci mancherai', function ($message) use ($request) {
            
                $message->to($request->email)->subject('Cancellazione Confermata');
            });
            
            // log unsubscription
            Log::info("Cancellata la mail {$request->email} con successo");
            
            // show message of successful unsubscription
            return redirect()->back()->with('status', 'Cancellazione completata');
        
        } catch (Exception $e) {
            
            // log error
            Log::error("Errore durante la cancellazione della mail {$request->email}: " . $e->getMessage());
            
            // redirect back error message
            return redirect()->back()->withErrors(['email' => 'Errore durante la cancellazione']);
        }
    }
    
    // fake registration API method
    private function fakeRegisterApi($email) {
        
        return true;
    }
    
    // fake unsubscription API method
    private function fakeUnregisterApi($email) {
        
        return true;
    }
}
