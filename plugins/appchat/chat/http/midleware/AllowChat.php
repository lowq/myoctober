<?php

namespace AppChat\Chat\Http\Middleware;

use AppChat\Chat\Models\Chat;
use Closure;

class AllowChat
{
    public function handle($request, Closure $next)
    {
        $message = $request->validate([
            'text' => 'string',
            'chatId' => 'required|numeric'
        ]);

        $chat = Chat::where('id', $message['chatId'])->first();


        if ($chat->users()->where('id',$request->user->id)->findOrFail()) {
            return $next($request);
        }
    }
}
