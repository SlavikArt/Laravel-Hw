<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->get('lang', 'en');
        app()->setLocale($lang);
        
        $welcomeMessage = Cache::remember("welcome_message_{$lang}", 300, function () {
            return __('messages.welcome');
        });
        
        return view('welcome', compact('welcomeMessage', 'lang'));
    }
}
