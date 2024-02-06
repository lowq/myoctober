<?php

namespace AppChat\Chat\Http\Controllers;

use AppChat\Chat\Models\Message;
use AppUser\User\Models\User;
use Backend\Classes\Controller;
use Illuminate\Http\Request;
use System\Models\File;

class MessageController extends Controller
{
    public function create(Request $request)
    {
        $message = $request->validate([
            'text' => 'string',
            'chatId' => 'required|numeric'
        ]);

        $file = post('file');

        $userCheck = User::where('name', 'Jarvis');

        if (file_exists($file)) {
            $uploadedFile = new File;
            $uploadedFile->data = $file; // The uploaded file data
            $uploadedFile->save();
            $newMessage = Message::create(
                [
                    'fileId' => $uploadedFile->id,
                    'appchat_chat_chats_id' => $message['chatId'],
                    'appuser_user_users_id' => $request->user->id,
                ]
            );
        } else {
            $newMessage = Message::create(
                [
                    'text' => $message['text'],
                    'appchat_chat_chats_id' => $message['chatId'],
                    'appuser_user_users_id' => $request->user->id,
                ]
            );
            if ($userCheck) {
                //TODO send message to OPENAI 
            }
            $newMessage = Message::create(
                [
                    'text' => 'message from idk',
                    'appchat_chat_chats_id' => $message['chatId'],
                    'appuser_user_users_id' => $userCheck->id,
                ]
            );
        }

        return response()->json($newMessage);
    }

    public function getMessagesByChatId($chat_id)
    {
        $messages = Message::where('appchat_chat_chats_id', $chat_id)->get();

        return response()->json($messages);
    }

    public function getFile(Request $request)
    {
        $fileId = $request->validate([
            'fileId' => 'required|integer',
        ]);

        $file = File::find($fileId);

        return response($file);
    }
}
