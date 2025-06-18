<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GreetingController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->get('lang', 'en');
        app()->setLocale($lang);
        
        return view('greeting', compact('lang'));
    }
}
