<?php

namespace AppAuth\Auth\Http\Middleware;

use AppUser\User\Http\Services\UserService;
use Closure;
use Illuminate\Support\Str;

class Authenticate
{
    public function handle($request, Closure $next)
    {
        $authorizationHeader = request()->bearerToken();
        if (Str::startsWith($authorizationHeader, 'Bearer ')) {
            $token = Str::substr($authorizationHeader, 7); // Remove 'Bearer ' from the beginning
        } else {
            // Handle the case where the header doesn't start with 'Bearer '
            throw new \Exception('Bad token');
        }

        $user = UserService::getAutheticatedUser($token);

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $request->user = $user;

        return $next($request);
    }
}
