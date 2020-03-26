<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('language_id');
            $table->string('address');
            $table->unsignedInteger('town_id');
            $table->unsignedInteger('client_id');
            $table->boolean('is_immediate')->default(true);
            $table->longText('instructions')->nullable();//This field is used for client to give instructions to livreur.
            $table->dateTime('start_date');
            $table->boolean('manually_handled')->default(false);//Manually handled by admin.
            $table->string('mobile')->nullable();
            $table->string('phone')->nullable();
            $table->unsignedInteger('status_id');
            $table->dateTime('completed_at')->nullable();
            $table->dateTime('cancelled_at')->nullable();
            $table->boolean('is_test')->default(false);
            $table->string('booker_name')->nullable();
            $table->string('coordinates')->nullable();
            $table->dateTime('expiry')->nullable();
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
        Schema::dropIfExists('commands');
    }
}
