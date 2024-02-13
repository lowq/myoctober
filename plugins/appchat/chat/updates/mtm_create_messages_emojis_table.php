<?php

namespace AppChat\Chat\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * ChatEmojis Migration
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
        Schema::table('appchat_chat_messages_emojis', function (Blueprint $table) {
            $table->integer('count')->default(0);
            $table->integer('messages_id')->unsigned();
            $table->integer('emoji_id')->unsigned();
            $table->primary(['messages_id', 'emoji_id']);
        });
    }

    /**
     * down reverses the migration
     */
    public function down()
    {
        Schema::dropIfExists('appchat_chat_messages_emojis');
    }
};
