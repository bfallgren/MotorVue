<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('motor_id')->unsigned();
            $table->foreign('motor_id')
            ->references('id')->on('motors')
            ->onDelete('cascade');
            $table->date('service_date');
            $table->string('location',50)->nullable();
            $table->decimal('cost',8,2)->nullable();
            $table->string('description',255)->nullable();
            $table->integer('mileage')->nullable();
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
        Schema::dropIfExists('services');
    }
}
