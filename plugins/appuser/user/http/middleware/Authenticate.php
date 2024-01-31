<?php
namespace AppUser\User\Http\Middleware;

use AppUser\User\Http\Services\UserService;
use Closure;
use Illuminate\Support\Str;

class Authenticate
{
    public function handle($request, Closure $next)
    {
        $authorizationHeader = $request->header('Authorization');
        if (Str::startsWith($authorizationHeader, 'Bearer ')) {
            $token = Str::substr($authorizationHeader, 7); // Remove 'Bearer ' from the beginning
        } else {
            // Handle the case where the header doesn't start with 'Bearer '
            $token = null;
        }

        $user = UserService::getAutheticatedUser($token);

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $request->user = $user;

        return $next($request);
    }
}
