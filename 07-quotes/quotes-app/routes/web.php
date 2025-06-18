<?php

use Illuminate\Support\Facades\Route;
use App\Mail\DailyQuote;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-quote-job', function () {
    $quote = 'The only way to do great work is to love what you do.';
    $author = 'Steve Jobs';
    foreach (User::all() as $user) {
        Mail::to($user->email)->send(new DailyQuote($quote, $author));
    }
    return 'Test quote sent!';
});
