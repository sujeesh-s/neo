<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingPgmQuestOptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_pgm_quest_options', function (Blueprint $table) {
            $table->id();
            $table->integer("qst_id");
            $table->string("options");
            $table->boolean("is_active")->default(1)->change();
            $table->boolean("is_deleted")->default(0)->change();
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
        Schema::dropIfExists('training_pgm_quest_options');
    }
}
