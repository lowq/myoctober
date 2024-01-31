<?php

namespace AppLogger\Logger\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

/**
 * CreateLogsTable Migration
 *
 * @link https://docs.octobercms.com/3.x/extend/database/structure.html
 */
return new class  extends Migration
{
    /**
     * up builds the migration
     */
    public function up()
    {
        Schema::create('applogger_logger_logs', function ($table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->dateTime('datetime');
            $table->foreignId('appuser_user_users_id')->constrained();
            $table->integer('delay');
        });
    }

    /**
     * down reverses the migration
     */
    public function down()
    {
        Schema::dropIfExists('applogger_logger_logs');
    }
};
