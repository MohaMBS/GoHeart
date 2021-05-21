<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSavesPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('saves_posts', function (Blueprint $table) {
            $table->foreign('post_id', 'saves_posts_ibfk_1')->references('id')->on('post')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('user_id', 'saves_posts_ibfk_2')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('saves_posts', function (Blueprint $table) {
            $table->dropForeign('saves_posts_ibfk_1');
            $table->dropForeign('saves_posts_ibfk_2');
        });
    }
}
