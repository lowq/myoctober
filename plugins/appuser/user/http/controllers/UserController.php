<?php

namespace AppUser\User\Http\Controllers;

use AppUser\User\Models\User;
use Backend\Classes\Controller;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request)
    {
        // Validácia dát
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'age'=> 'required|integer',
            'username' => 'required|string|unique:appuser_user_users',
            'password' => 'required|string|min:6'
        ]);

        // Vytvorenie nového uzívateľa
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'age'=> $request->age,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'token' => str_random(50), // Vytvorenie náhodného tokenu
        ]);

        return response()->json(['token' => $user->token]);
    }

    public function login(Request $request)
    {
        // Validácia dát
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Overenie prihlasovacích údajov
        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        return response()->json(['token' => $user->token]);
    }
}
