<?php

namespace AppUser\User\Models;

use AppChat\Chat\Models\Message;
use AppLogger\Logger\Models\Logs;
use Model;

/**
 * User Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class User extends Model
{
    /**
     * @var string table name
     */
    public $table = 'appuser_user_users';

    protected $fillable = [
        'name', 'email', 'age', 'username', 'password', 'token', 'google_token', 'google_refresh_token'
        // Add other user information fields as needed
    ];

    protected $hidden = [
        'password', 'token'
        // Hide other sensitive fields as needed
    ];

    public function logs()
    {
        return $this->hasMany(Logs::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public $belongsToMany = [
        'chats' => [
            \AppChat\Chat\Models\Chat::class,
            'table' => 'appchat_chat_chat_user',
            'key' => 'appuser_user_users_id',
            'otherKey' => 'appchat_chat_chats_id'
        ]
    ];
}
