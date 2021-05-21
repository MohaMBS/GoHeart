<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToFavoritesPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('favorites_posts', function (Blueprint $table) {
            $table->foreign('user_id', 'favorites_posts_ibfk_1')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('post_id', 'favorites_posts_ibfk_2')->references('id')->on('post')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('favorites_posts', function (Blueprint $table) {
            $table->dropForeign('favorites_posts_ibfk_1');
            $table->dropForeign('favorites_posts_ibfk_2');
        });
    }
}
