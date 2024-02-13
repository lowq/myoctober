<?php

namespace AppChat\Chat\Http\Controllers;

use AppChat\Chat\Models\Chat;
use AppChat\Chat\Models\Message;
use AppUser\User\Models\User;
use Backend\Classes\Controller;
use Illuminate\Http\Request;
use System\Models\File;
use OpenAI\Laravel\Facades\OpenAI;

class MessageController extends Controller
{
    public function create(Request $request)
    {
        $message = $request->validate([
            'text' => 'string',
            'chatId' => 'required|numeric'
        ]);

        $file = post('file');

        $userCheck = User::where('username', 'Jarvis');

        $chat = Chat::where('id', $message['chatId'])->first();

        if (file_exists($file)) {
            $uploadedFile = new File;
            $uploadedFile->data = $file; // The uploaded file data
            $uploadedFile->save();

            //TODO use october cms attach


            $newMessage = $chat->messages()->create(
                [
                    'fileId' => $uploadedFile->id,
                    'appuser_user_users_id' => $request->user->id,
                ]
            );
        } else {
            $newMessage = $chat->messages()->create(
                [
                    'text' => $message['text'],
                    'appuser_user_users_id' => $request->user->id,
                ]
            );
            if ($chat->users()->where('id',$userCheck->id)->findOrFail()) {
                //send message to OPENAI
                $result = OpenAI::chat()->create([
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [
                        ['role' => 'user', 'content' => $message['text']],
                    ],
                ]);
                $newMessage = $chat->messages()->create(
                    [
                        'text' => $result->choices[0]->message->content,
                        'appuser_user_users_id' => $userCheck->id,
                    ]
                );
            }

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
