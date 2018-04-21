<?php

namespace App\Providers;

use App\Policies\QuotePolicy;
use App\Quote;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $policies = [
        Quote::class => QuotePolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
