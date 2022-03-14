<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingPrgmsAssignments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_prgms_assignments', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->integer("program_id");
            $table->integer("content_id");
            $table->integer("user_role");
            $table->boolean('is_temp')->default(0);
            $table->boolean('status')->default(0);
            $table->boolean('is_approved')->default(0);
            $table->integer("approved_by");
            $table->integer("rating");
            $table->dateTime('end_date', $precision = 0);
            $table->boolean("is_active")->default(1);
            $table->boolean("is_deleted")->default(0);
            $table->integer("created_by")->nullable();
            $table->integer("updated_by")->nullable();
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
        Schema::dropIfExists('training_prgms_assignments');
    }
}
