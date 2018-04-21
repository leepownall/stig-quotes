<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Blade::if('env', function ($environment) {
            return app()->environment($environment);
        });
    }

    public function register(): void
    {
        //
    }
}
