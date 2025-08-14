<?php

namespace App\Providers;

use App\Http\Middleware\AuthCheck;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('AuthCheck', function ($app) {
            return new AuthCheck();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
