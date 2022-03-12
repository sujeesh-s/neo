<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantOrganization extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenant_organization', function (Blueprint $table) {
            $table->id();
            $table->string("tenant_id");
            $table->string('name');
            $table->string('job');
            $table->string('org_name');
            $table->integer("country");
            $table->string('email');
            $table->integer('phone');
            $table->string('username');
            $table->string('password');
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
        Schema::dropIfExists('tenant_organization');
    }
}
