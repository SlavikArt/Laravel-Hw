<?php

namespace App\Providers;

use App\Jobs\SendDailyQuote;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schedule::job(new SendDailyQuote())->dailyAt('08:00')->timezone('Europe/Kyiv');
    }
}
