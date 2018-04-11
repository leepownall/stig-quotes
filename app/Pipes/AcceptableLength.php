<?php

namespace App\Pipes;

use App\Quote;
use Closure;

class AcceptableLength
{
    public function handle(Quote $quote, Closure $next)
    {
        if (strlen($quote->body) < 20) {
            $quote->delete();
        }

        return $next($quote);
    }
}
