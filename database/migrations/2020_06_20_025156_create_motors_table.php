<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMotorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('motor_type');
            $table->string('make',50);
            $table->string('model',50);
            $table->year('mfg_year');
            $table->integer('current_mileage');
            $table->string('vid',20)->nullable();
            $table->string('license_tag',20)->nullable();
            $table->string('insurance_provider',50)->nullable();
            $table->string('insurance_policy',50)->nullable();
            $table->string('mfg_warr',20)->nullable();
            $table->string('ext_warr',20)->nullable();
            $table->string('ext_warr_provider',50)->nullable();
            $table->string('ext_warr_phone',50)->nullable();
            $table->string('ext_warr_contract',50)->nullable();
            $table->string('avatar')->nullable();
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
        Schema::dropIfExists('motors');
    }
}
