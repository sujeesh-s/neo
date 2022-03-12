<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemoRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demo_requests', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("title");
            $table->string("org_name");
            $table->integer("country_id");
            $table->string("email");
            $table->string("phone");
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
        Schema::dropIfExists('demo_requests');
    }
}
