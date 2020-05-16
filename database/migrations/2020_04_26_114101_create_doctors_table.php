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
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username');
            $table->date('date_of_birth');
            $table->string('gender');
            $table->string('address');
            $table->string('country');
            $table->string('city');
            $table->string('state');
            $table->string('phone');
            $table->string('qualification');
            $table->string('department');
            $table->longText('experience');
            $table->longText('education');
            $table->string('skills');
            $table->string('notes');
            $table->longText('short_biography');
            $table->string('days');
            $table->time('start_timing');
            $table->time('finish_timing'); 
            $table->string('hospital_name');
            $table->string('hospital_days');
            $table->time('hospital_start_timing');
            $table->time('hospital_finish_timing');
            $table->string('hospital_address');
            $table->integer('balance')->default(0);
            $table->integer('is_registered')->default(0);
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('doctors', function (Blueprint $table) {
            //
        });
    }
}
