<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManageAds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_ads', function (Blueprint $table) {
            $table->id();
            $table->string("ad_title");
            $table->enum('ad_type', ['image', 'video']);
            $table->text("content")->collation('utf16_general_ci')->nullable();
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
        Schema::dropIfExists('manage_ads');
    }
}
