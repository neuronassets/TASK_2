<?php

use App\Http\Controllers\NewsletterController;
use Illuminate\Support\Facades\Route;

// define which method of the NewsletterController class must be used based on the route

Route::get('/newsletter/register', [NewsletterController::class, 'showRegisterForm'])->name('newsletter.register');

Route::post('/newsletter/register', [NewsletterController::class, 'registerEmail'])->name('newsletter.register.submit');

Route::get('/newsletter/unsubscribe', [NewsletterController::class, 'showUnsubscribeForm'])->name('newsletter.unsubscribe');

Route::post('/newsletter/unsubscribe', [NewsletterController::class, 'unsubscribeEmail'])->name('newsletter.unsubscribe.submit');
