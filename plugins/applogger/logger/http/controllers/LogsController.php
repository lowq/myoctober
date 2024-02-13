<?php

namespace AppLogger\Logger\Http\Controllers;

use AppLogger\Logger\Models\Logs;
use AppUser\User\Models\User;
use Backend\Classes\Controller;
use Illuminate\Http\Request;

class LogsController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->validate([
            'delay' => 'required|integer',
        ]);

        $log = $request->user->create([
            'datetime' => now(),
            'appuser_user_users_id' => $request->user->id,
            'delay' => $data['delay'],
        ]);

        return response()->json($log, 201);
    }

    public function getAllLogs(Request $request)
    {
        $logs = Logs::where('appuser_user_users_id', $request->user->id)->get();
        return response()->json($logs);
    }

    public function getLogByUsername($username)
    {
        $user = User::where('username', $username)->firstOrFail();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $logs = Logs::where('appuser_user_users_id', $user->id)->findOrFail();
        return response()->json($logs);
    }
}
