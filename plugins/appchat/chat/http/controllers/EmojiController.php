<?php

namespace AppChat\Chat\Http\Controllers;

use AppChat\Chat\Models\Emoji;
use AppChat\Chat\Models\Message;
use Backend\Classes\Controller;
use Illuminate\Http\Request;

class EmojiController extends Controller
{
    public function getAllEmojis()
    {
        $emojis = Emoji::all();

        return response()->json($emojis);
    }

    public function setEmojiToMessage(Request $request)
    {
        $data = $request->validate([
            'emojiId' => 'required|integer',
            'messageId' => 'required|integer',
        ]);

        $emoji = Emoji::where('id', $data['emojiId'])->first();
        $message = Message::where('id', $data['messageId'])->first();

        $localCount = $message->emojis->where('emojiId', $data['emojiId'])->first()->pivot->count;

        $message->emojis()->attach($emoji, ['count' => $localCount + 1]);
    }

    public function removeOneEmojiToMessage(Request $request)
    {
        $data = $request->validate([
            'emojiId' => 'required|integer',
            'messageId' => 'required|integer',
        ]);

        $emoji = Emoji::where('id', $data['emojiId'])->first();
        $message = Message::where('id', $data['messageId'])->first();

        $localCount = $message->emojis->where('emojiId', $data['emojiId'])->first()->pivot->count;

        $message->emojis()->attach($emoji, ['count' => ($localCount - 1) <= 0 ? 0 : $localCount]);
    }
}
