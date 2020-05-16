<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('payment_amount');
            $table->unsignedInteger('doctor_id');
            $table->foreign('doctor_id', 'doctor_fk_1422226')->references('id')->on('doctors');
            $table->unsignedInteger('patient_id');
            $table->foreign('patient_id', 'patient_fk_1422227')->references('id')->on('patients');
            $table->unsignedInteger('appointment_id');
            $table->foreign('appointment_id', 'appointment_fk_1422228')->references('id')->on('appointments');
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
        Schema::dropIfExists('payments');
    }
}
