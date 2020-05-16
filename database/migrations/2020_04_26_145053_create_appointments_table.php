<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->date('start_date');
            $table->time('start_time');
            $table->string('status');
            $table->longText('appointment_desc');
            $table->string('type');

            $table->unsignedInteger('patient_id');
            $table->foreign('patient_id', 'patient_fk_1373424')->references('id')->on('patients');
            $table->unsignedInteger('doctor_id');
            $table->foreign('doctor_id', 'doctor_fk_1373425')->references('id')->on('doctors');


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
        Schema::dropIfExists('appointments');
    }
}
