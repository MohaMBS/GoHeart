<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypepostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('typeposts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 150);
            $table->timestamps();
        });

        DB::table('typeposts')->insert(
            array(
                'name' => 'Ejercico',
            )
        );
        DB::table('typeposts')->insert(
            array(
                'name' => 'Dieta',
            )
        );
        DB::table('typeposts')->insert(
            array(
                'name' => 'Blog',
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('typeposts');
    }
}
