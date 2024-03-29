<?php

namespace AppChat\Chat\Models;

use AppUser\User\Models\User;
use Model;

/**
 * Message Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class Message extends Model
{

    /**
     * @var string table name
     */
    public $table = 'appchat_chat_messages';

    protected $fillable = ['text', 'fileId', 'chats_id', 'users_id'];

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public $belongsToMany = [
        'emojis' => [
            \AppChat\Chat\Models\Emoji::class, 'table' => 'appchat_chat_messages_emojis',
            'key' => 'messages_id',
            'otherKey' => 'emoji_id'
        ], 'pivot' => ['count']
    ];
}
