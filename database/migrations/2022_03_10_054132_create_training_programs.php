<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingPrograms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_programs', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("desc");
            $table->integer("category");
            $table->integer("subcategory");
            $table->dateTime('start_date', $precision = 0);
            $table->dateTime('end_date', $precision = 0);
            $table->integer("badge");
            $table->integer("training_level");
            $table->string("applicable_for");
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
        Schema::dropIfExists('training_programs');
    }
}
