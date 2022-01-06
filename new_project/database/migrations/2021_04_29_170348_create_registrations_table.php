<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('std_1_name')->nullable();
            $table->string('std_2_name')->nullable();
            $table->string('std_1_roll_no')->nullable()->unique();
            $table->string('std_2_roll_no')->nullable()->unique();
            $table->string('std_1_email')->unique();
            $table->string('std_2_email')->nullable()->unique();
            $table->string('std_1_session')->nullable()->nullable();
            $table->string('std_2_session')->nullable()->nullable();
            $table->foreignId('department_id')->constrained();
            $table->boolean('is_registered')->default(0);
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
        Schema::dropIfExists('registrations');
    }
}