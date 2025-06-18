<?php

namespace App\Providers;

use App\Services\CurrencyConverter;
use Illuminate\Support\ServiceProvider;

class CurrencyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CurrencyConverter::class, function ($app) {
            return new CurrencyConverter();
        });

        $this->app->alias(CurrencyConverter::class, 'currency');
    }

    public function boot(): void
    {
        //
    }
} 