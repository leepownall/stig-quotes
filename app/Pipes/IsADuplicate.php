<?php

namespace App\Pipes;

use App\Quote;
use Closure;

class IsADuplicate
{
    public function handle(Quote $quote, Closure $next)
    {
        if (Quote::where('body', $quote->body)->count() > 1) {
            $quote->delete();
        }

        return $next($quote);
    }
}
