<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GreetingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WelcomeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/greeting', [GreetingController::class, 'index']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/welcome', [WelcomeController::class, 'index']);
