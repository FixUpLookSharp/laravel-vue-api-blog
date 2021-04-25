<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationToTableChats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chats', function (Blueprint $table) {
            $table->foreign('subscriber1_id', 'chats_subscriber1_id_foreign')->references('id')->on('users');
            $table->foreign('subscriber2_id', 'chats_subscriber2_id_foreign')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chats', function (Blueprint $table) {
            $table->dropForeign('chats_subscriber1_id_foreign');
            $table->dropForeign('chats_subscriber2_id_foreign');
        });
    }
}
