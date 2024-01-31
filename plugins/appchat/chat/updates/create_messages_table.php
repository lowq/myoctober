<?php

namespace AppChat\Chat\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateMessagesTable Migration
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
        Schema::create('appchat_chat_messages', function (Blueprint $table) {
            $table->id();
            $table->string('text')->nullable();
            $table->integer('fileId')->nullable();
            $table->foreignId('appchat_chat_chats_id')->constrained();
            $table->foreignId('appuser_user_users_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * down reverses the migration
     */
    public function down()
    {
        Schema::dropIfExists('appchat_chat_messages');
    }
};
