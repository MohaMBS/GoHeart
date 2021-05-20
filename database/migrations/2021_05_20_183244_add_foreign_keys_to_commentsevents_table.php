<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCommentseventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commentsevents', function (Blueprint $table) {
            $table->foreign('user_id', 'commentsevents_ibfk_1')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('event_id', 'commentsevents_ibfk_2')->references('id')->on('events')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commentsevents', function (Blueprint $table) {
            $table->dropForeign('commentsevents_ibfk_1');
            $table->dropForeign('commentsevents_ibfk_2');
        });
    }
}
