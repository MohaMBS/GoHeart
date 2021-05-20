<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->foreign('post_id', 'reports_ibfk_1')->references('id')->on('post')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('user_id', 'reports_ibfk_2')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropForeign('reports_ibfk_1');
            $table->dropForeign('reports_ibfk_2');
        });
    }
}
