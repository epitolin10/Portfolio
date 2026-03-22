<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Render, Azure (et la plupart des hébergeurs cloud) utilisent un proxy HTTPS.
        // Laravel reçoit les requêtes en HTTP en interne mais le visiteur
        // est en HTTPS → on force les URLs générées en HTTPS.
        if (config('app.env') !== 'local' || request()->header('x-forwarded-proto') === 'https') {
            URL::forceScheme('https');
        }
    }
}