<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingPgmLiveSession extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_pgm_live_session', function (Blueprint $table) {
            $table->id();
            $table->string("session_title");
            $table->string("session_name");
            $table->string("desc");
            $table->integer("trainer");
            $table->dateTime('date', $precision = 0);
            $table->dateTime('start_time', $precision = 0);
            $table->integer("duration");
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
        Schema::dropIfExists('training_pgm_live_session');
    }
}
