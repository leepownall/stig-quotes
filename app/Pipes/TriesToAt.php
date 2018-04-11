<?php

namespace App\Pipes;

use App\Quote;
use Closure;

class TriesToAt
{
    public function handle(Quote $quote, Closure $next)
    {
        if (str_contains($quote->body, '@')) {
            $quote->delete();
        }

        return $next($quote);
    }
}
