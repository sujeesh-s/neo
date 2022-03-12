<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrgUserRoleMapping extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('org_user_role_mapping', function (Blueprint $table) {
            $table->id();
            $table->integer("role_id");
            $table->integer("module_id");
            $table->integer("org_id");
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
        Schema::dropIfExists('org_user_role_mapping');
    }
}
