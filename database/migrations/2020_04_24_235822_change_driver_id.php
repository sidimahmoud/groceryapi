<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDriverId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('driver_gains', function (Blueprint $table) {
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
        Schema::table('driver_gains', function (Blueprint $table) {
            $table->renameColumn( 'driver_data_id','driver_id');
        });
    }
}
