<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageSelectedFeatures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_selected_features', function (Blueprint $table) {
            $table->id();
            $table->integer("package_id");
            $table->integer("feature_id");
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
        Schema::dropIfExists('package_selected_features');
    }
}
