<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderedTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordered_times', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            $table->dateTime('order_open_time_utc');
            $table->dateTime('order_open_time_israel');
            $table->dateTime('departure_time_israel');
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
        Schema::dropIfExists('ordered_times');
    }
}
