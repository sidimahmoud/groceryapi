<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDriverOrderId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_drivers', function (Blueprint $table) {
            $table->renameColumn( 'driver_id','driver_data_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_drivers', function (Blueprint $table) {
            $table->renameColumn( 'driver_data_id','driver_id');
        });
    }
}
