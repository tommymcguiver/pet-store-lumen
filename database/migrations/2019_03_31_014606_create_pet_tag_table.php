<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePetTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pet_tag', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('pet_id')->unsigned();
            $table->bigInteger('tag_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('pet_tag', function (Blueprint $table) {
            $table->foreign('pet_id')->references('id')->on('pets');
            $table->foreign('tag_id')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pet_tag', function (Blueprint $table) {
            $table->dropForeign(['pet_id']);
            $table->dropForeign(['tag_id']);
        });

        Schema::dropIfExists('pet_tag');
    }
}
