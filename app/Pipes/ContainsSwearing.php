<?php

namespace App\Pipes;

use App\Quote;
use Closure;

class ContainsSwearing
{
    public function handle(Quote $quote, Closure $next)
    {
        if (str_contains($quote->body, $this->swearWords())) {
            $quote->delete();
        }

        return $next($quote);
    }

    private function swearWords(): array
    {
        return [
            'shit',
            'fuck',
            'cunt',
        ];
    }
}
