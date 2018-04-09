<?php

namespace App\Http\Middleware;

use Closure;

class SentryContext
{
    public function handle($request, Closure $next)
    {
        if (app()->bound('sentry')) {
            /** @var \Raven_Client $sentry */
            $sentry = app('sentry');

            if (auth()->check()) {
                $sentry->user_context(['id' => auth()->user()->id]);
            } else {
                $sentry->user_context(['id' => null]);
            }
        }

        return $next($request);
    }
}
