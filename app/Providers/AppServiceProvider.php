<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

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
        // Tambahkan baris ini untuk memaksa HTTPS di produksi
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // set validate password to check for this fields
        Password::defaults(function () {
            return Password::min(8)
            ->letters()
            ->numbers()
            ->symbols()
            ->mixedCase();
        });
    }
}
