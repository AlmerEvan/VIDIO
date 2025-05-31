<?php

namespace App\Http\Middleware;

use Closure;

class UserMiddleware
{
    public function handle($request, Closure $next)
    {
        if ($request->input('user') != 'admin') {
            return response('Silakan login terlebih dahulu.', 403);
        }

        return $next($request);
    }
}
