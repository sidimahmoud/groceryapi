<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldDriverData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('driver_data', function (Blueprint $table) {
            $table->boolean('has_course')->default(false);
            $table->boolean('available')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('driver_data', function (Blueprint $table) {
            $table->dropColumn('has_course');
            $table->dropColumn('available');
        });
    }
}
