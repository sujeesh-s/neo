<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrgUserGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('org_user_groups', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("desc");
            $table->integer("branch_id");
            $table->integer("department_id");
            $table->integer("training_levels");
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
        Schema::dropIfExists('org_user_groups');
    }
}
