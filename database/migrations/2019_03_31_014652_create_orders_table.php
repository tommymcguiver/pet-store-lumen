<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('status_id')->unsigned();
            $table->bigInteger('pet_id')->unsigned();
            $table->integer('quantity');
            $table->dateTime('shipDate');
            $table->timestamps();

        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('pet_id')->references('id')->on('pets');
            $table->foreign('status_id')->references('id')->on('order_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['pet_id']);
            $table->dropForeign(['status_id']);
        });

        Schema::dropIfExists('orders');
    }
}
