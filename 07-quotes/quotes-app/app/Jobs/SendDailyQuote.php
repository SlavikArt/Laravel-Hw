<?php

namespace App\Jobs;

use App\Mail\DailyQuote;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class SendDailyQuote implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $response = Http::get('https://api.quotable.io/random');
        
        if ($response->successful()) {
            $data = $response->json();
            $quote = $data['content'];
            $author = $data['author'];
            
            $users = User::all();
            
            foreach ($users as $user) {
                Mail::to($user->email)->send(new DailyQuote($quote, $author));
            }
        }
    }
}
