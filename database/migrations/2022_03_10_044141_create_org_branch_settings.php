<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrgBranchSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('org_branch_settings', function (Blueprint $table) {
            $table->id();
            $table->integer("branch_id");
            $table->boolean("contractors")->default(0);
            $table->integer("contractor_category");
            $table->boolean("sub_contractors")->default(0);
            $table->integer("sub_contractor_category");
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
        Schema::dropIfExists('org_branch_settings');
    }
}
