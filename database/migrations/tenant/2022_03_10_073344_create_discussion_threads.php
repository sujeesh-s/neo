<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscussionThreads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discussion_threads', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("desc");
            $table->integer("branch_id");
            $table->integer("department_id");
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
        Schema::dropIfExists('discussion_threads');
    }
}
