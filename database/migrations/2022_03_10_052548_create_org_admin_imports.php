<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrgAdminImports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('org_admin_imports', function (Blueprint $table) {
            $table->id();
            $table->string("file");
            $table->boolean("status");
            $table->boolean("is_active")->default(1)->change();
            $table->boolean("is_deleted")->default(0)->change();
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
        Schema::dropIfExists('org_admin_imports');
    }
}
