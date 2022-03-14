<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganization extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->text("desc")->collation('utf16_general_ci')->nullable();
            $table->string("type");
            $table->integer("business_category_id");
            $table->string("website")->nullable();
            $table->enum('employee_range', ['10-50', '50-100', 'Above 100']);
            $table->integer("language_id");
            $table->integer("org_admin");
            $table->string("email");
            $table->string("phone");
            $table->boolean("is_approved");
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
        Schema::dropIfExists('organization');
    }
}
