<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->datetime('time');
            $table->unsignedInteger('patient_id');
            $table->foreign('patient_id', 'patient_fk_1440047')->references('id')->on('patients');
            $table->unsignedInteger('doctor_id');
            $table->foreign('doctor_id', 'doctor_fk_1440048')->references('id')->on('doctors');
            $table->unsignedInteger('appointment_id');
            $table->foreign('appointment_id', 'appointment_fk_1440049')->references('id')->on('appointments');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('session');
    }
}
