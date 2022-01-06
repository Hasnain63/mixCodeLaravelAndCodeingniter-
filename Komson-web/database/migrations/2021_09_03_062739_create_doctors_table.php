<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('brick_name');
            $table->integer('pmdc_no');
            $table->string('name');
            $table->dateTime('dateof_birth');
            $table->integer('cnic');
            $table->integer('mobile');
            $table->string('qualification');
            $table->string('designation');
            $table->string('morning_address');
            $table->string('evening_address');
            $table->integer('par_day_patients');
            $table->integer('status');
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
        Schema::dropIfExists('doctors');
    }
}