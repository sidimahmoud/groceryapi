<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_drivers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('driver_id');
            $table->string('name')->nullable();
            $table->string('gender')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->unsignedInteger('language_id')->nullable();
            $table->dateTime('cancelled_at')->nullable();
            $table->unsignedInteger('temp_travel_time')->nullable();
            $table->unsignedInteger('temp_travel_distance')->nullable();
            $table->boolean('is_late')->default(false);
            $table->integer('delay')->nullable();
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
        Schema::dropIfExists('order_drivers');
    }
}
