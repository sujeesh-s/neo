<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrgAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('org_admin', function (Blueprint $table) {
            $table->id();
            $table->string("fname");
            $table->string("lname")->nullable();
            $table->string("email");
            $table->string("username");
            $table->string("isd_code")->nullable();
            $table->string("phone");
            $table->timestamp('email_verified_at')->nullable();
            $table->string("password");
            $table->integer("role_id")->nullable();
            $table->integer("branch_id")->nullable();
            $table->integer("department_id")->nullable();
            $table->string("job_title")->nullable();
            $table->string("avatar")->nullable();
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
        Schema::dropIfExists('org_admin');
    }
}
