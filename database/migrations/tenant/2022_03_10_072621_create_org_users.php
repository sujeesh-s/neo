<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrgUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('org_users', function (Blueprint $table) {
            $table->id();
            $table->string("fname");
            $table->string("lname");
            $table->string("email");
            $table->string("isd_code");
            $table->string("phone");
            $table->timestamp('email_verified_at');
            $table->string("password");
            $table->integer("role_id");
            $table->integer("branch_id");
            $table->integer("department_id");
            $table->integer("designation");
            $table->integer("group_id");
            $table->string("job_title")->nullable();
            $table->string("avatar")->nullable();
            $table->boolean("is_active")->default(1);
            $table->boolean("is_deleted")->default(0);
            $table->boolean('is_temporary')->default(0);
            $table->dateTime('end_date', $precision = 0);
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
        Schema::dropIfExists('org_users');
    }
}
