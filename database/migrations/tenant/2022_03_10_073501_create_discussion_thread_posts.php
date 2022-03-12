<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscussionThreadPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discussion_thread_posts', function (Blueprint $table) {
            $table->id();
            $table->integer("thread_id");
            $table->string("title");
            $table->text("content")->collation('utf16_general_ci')->nullable();
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
        Schema::dropIfExists('discussion_thread_posts');
    }
}
