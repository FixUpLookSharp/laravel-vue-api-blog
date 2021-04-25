<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationToTableArticleLike extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('article_likes', function (Blueprint $table) {
            $table->foreign('article_id', 'article_likes_article_id_foreign')->references('id')->on('articles');
            $table->foreign('user_id', 'article_likes_user_id_foreign')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('article_likes', function (Blueprint $table) {
            $table->dropForeign('article_likes_article_id_foreign');
            $table->dropForeign('article_likes_user_id_foreign');

        });
    }
}
