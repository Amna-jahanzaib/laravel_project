<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecommendedExercises extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatment_records', function (Blueprint $table) {
            $table->id();
            $table->longText('problem_diagnosed');
            $table->longText('recommended_medicine');
            $table->longText('improvements');
            $table->date('next_session_date');
            $table->time('next_session_time');
            $table->unsignedInteger('exercise_id');
            $table->foreign('exercise_id', 'exercise_fk_1453599')->references('id')->on('exercises');
            $table->unsignedInteger('session_id');
            $table->foreign('session_id', 'session_fk_1453600')->references('id')->on('sessions');
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
        Schema::dropIfExists('recommended_exercises');
    }
}
