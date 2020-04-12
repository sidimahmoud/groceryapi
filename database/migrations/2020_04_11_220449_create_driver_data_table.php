<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->string('name');
            $table->string('address');
            $table->unsignedInteger('town_id');
            $table->string('city')->nullable();
            $table->string('town_name')->nullable();
            $table->string('post_code')->nullable();
            $table->string('coordinates')->nullable();
            $table->integer('tax')->nullable();
            $table->string('tax_type')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->boolean('has_training_certificate')->default(false);
            $table->boolean('has_police_background')->default(false);
            $table->boolean('has_contract')->default(false);
            $table->boolean('has_driving_license')->default(false);
            $table->string('image')->nullable();
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
        Schema::dropIfExists('driver_data');
    }
}
