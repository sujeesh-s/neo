<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignedTrainingPrograms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assigned_training_programs', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->integer("program_id");
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
        Schema::dropIfExists('assigned_training_programs');
    }
}
