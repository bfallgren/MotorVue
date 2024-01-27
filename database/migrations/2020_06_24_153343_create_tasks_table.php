<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('motor_id')->unsigned();
            $table->foreign('motor_id')
            ->references('id')->on('motors')
            ->onDelete('cascade');
            $table->integer('mileage_interval')->nullable();
            $table->integer('month_interval')->nullable();
            $table->integer('last_completed_miles')->nullable();
            $table->date('last_completed_date')->nullable();
            $table->integer('next_sched_maint')->nullable();
            $table->string('description',255)->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
