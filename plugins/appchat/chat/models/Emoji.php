<?php

namespace AppChat\Chat\Models;

use Model;

/**
 * Emoji Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class Emoji extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table name
     */
    public $table = 'appchat_chat_emoji';

    public $timestamps = false;
    /**
     * @var array rules for validation
     */
    public $rules = [];
    protected $fillable = ['name', 'icon'];

    public $belongsToMany = [
        'messages' => [\AppChat\Chat\Models\Message::class, 'table' => 'appchat_chat_messages_emojis'], 'pivot' => ['count']
    ];
}
