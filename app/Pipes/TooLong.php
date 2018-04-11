<?php

namespace App\Pipes;

use App\Quote;
use Closure;

class TooLong
{
    public function handle(Quote $quote, Closure $next)
    {
        if (strlen($quote->body) > 280) {
            $quote->delete();
        }

        return $next($quote);
    }
}
