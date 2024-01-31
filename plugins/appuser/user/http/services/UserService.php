<?php

namespace AppUser\User\Http\Services;

use AppUser\User\Models\User;

class UserService
{
    public static function getAutheticatedUser($token)
    {
        return User::where('token', $token)->first();
    }
}
