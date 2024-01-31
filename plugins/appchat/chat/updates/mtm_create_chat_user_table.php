<?php

namespace AppChat\Chat\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * ChatUser Migration
 *
 * @link https://docs.octobercms.com/3.x/extend/database/structure.html
 */
return new class extends Migration
{
    /**
     * up builds the migration
     */
    public function up()
    {
        Schema::table('appchat_chat_chat_user', function (Blueprint $table) {
            $table->integer('appchat_chat_chats_id')->unsigned();
            $table->integer('appuser_user_users_id')->unsigned();
            $table->primary(['appchat_chat_chats_id', 'appuser_user_users_id']);
        });
    }

    /**
     * down reverses the migration
     */
    public function down()
    {
        Schema::dropIfExists('appchat_chat_chat_user');
    }
};
