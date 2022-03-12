<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingPgmQuestResponses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_pgm_quest_responses', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->integer("assessment_id");
            $table->integer("qst_id");
            $table->string("answer");
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
        Schema::dropIfExists('training_pgm_quest_responses');
    }
}
