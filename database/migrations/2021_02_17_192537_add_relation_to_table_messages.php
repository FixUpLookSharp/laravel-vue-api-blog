<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationToTableMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->foreign('chat_id', 'messages_chat_id_foreign')->references('id')->on('chats');
            $table->foreign('author_id', 'messages_author_id_foreign')->references('id')->on('users');
            $table->foreign('recepient_id', 'messages_recepient_id_foreign')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign('messages_chat_id_foreign');
            $table->dropForeign('messages_author_id_foreign');
            $table->dropForeign('messages_recepient_id_foreign');
        });
    }
}
