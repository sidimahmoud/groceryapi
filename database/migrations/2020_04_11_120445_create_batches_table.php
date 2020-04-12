<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('driver_id');
            $table->dateTime('will_send_at');
            $table->dateTime('sent_at')->nullable();
            $table->unsignedInteger('dispatch_interval')->default(0);
            $table->boolean('viewable')->default(false);
            $table->dateTime('accepted_at')->nullable();
            $table->dateTime('cancelled_at')->nullable();
            $table->dateTime('rejected_at')->nullable();
            $table->double('temp_travel_distance')->nullable();
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
        Schema::dropIfExists('batches');
    }
}
