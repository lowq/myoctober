<?php

namespace AppLogger\Logger\Models;

use AppUser\User\Models\User;
use Model;

/**
 * Logs Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class Logs extends Model
{
    protected $fillable = ['datetime', 'appuser_user_users_id', 'delay'];

    protected $dates = ['datetime'];

    public $timestamps = false;
    /**
     * @var string table name
     */
    public $table = 'applogger_logger_logs';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
