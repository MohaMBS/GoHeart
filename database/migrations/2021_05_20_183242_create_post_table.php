<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('active')->default(1);
            $table->string('security_token', 50)->nullable();
            $table->string('creator_name');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('typepost_id')->index('typepost_id');
            $table->string('title', 250);
            $table->text('body');
            $table->text('front_page')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
            $table->index(['user_id', 'typepost_id'], 'user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post');
    }
}
