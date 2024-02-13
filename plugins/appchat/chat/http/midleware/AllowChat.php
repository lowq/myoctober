<?php

namespace AppChat\Chat\Http\Middleware;

use Closure;

class AllowChat
{
    public function handle($request, Closure $next)
    {


        return $next($request);
    }
}
