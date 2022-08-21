<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_history', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedInteger('ingredient_id');
            $table->foreign('ingredient_id')->references('id')->on('ingredients')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('old_value');
            $table->integer('value');

            $table->unsignedInteger('measure_id');
            $table->foreign('measure_id')->references('id')->on('measures')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_history');
    }
}
