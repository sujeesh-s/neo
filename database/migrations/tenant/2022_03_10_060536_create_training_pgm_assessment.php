<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingPgmAssessment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_pgm_assessment', function (Blueprint $table) {
            $table->id();
            $table->integer("program_id");
            $table->string("assessment_name");
            $table->integer("num_of_quest");
            $table->integer("score_per_quest");
            $table->boolean("sort_order")->default(1);
            $table->integer("duration");
            $table->integer("pass_percnt");
            $table->boolean("retakes")->default(0);
            $table->boolean("status");
            $table->boolean("is_active")->default(1);
            $table->boolean("is_deleted")->default(0);
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
        Schema::dropIfExists('training_pgm_assessment');
    }
}
