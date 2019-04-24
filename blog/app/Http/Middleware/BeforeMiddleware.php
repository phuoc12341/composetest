<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class BeforeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($test = $request->headers->get('Test')) {
            if ($test === 'abort') {
                return new Response('Request Aborted', 400);
            }
            $request->headers->remove('Test');
        }

        return $next($request);
    }
}
