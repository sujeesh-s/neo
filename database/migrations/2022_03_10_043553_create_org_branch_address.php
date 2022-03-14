<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrgBranchAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('org_branch_address', function (Blueprint $table) {
            $table->id();
            $table->integer("branch_id");
            $table->string("address");
            $table->string("address_2")->nullable();
            $table->integer("city_id");
            $table->integer("state_id");
            $table->integer("country_id");
            $table->string("zipcode");
            $table->string("latitude");
            $table->string("longitude");
            $table->string("post_office");
            $table->boolean("is_active")->default(1);
            $table->boolean("is_deleted")->default(0);
            $table->boolean("is_default")->default(1);
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
        Schema::dropIfExists('org_branch_address');
    }
}
