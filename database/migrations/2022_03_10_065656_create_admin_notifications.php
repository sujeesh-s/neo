<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminNotifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_notifications', function (Blueprint $table) {
            $table->id();
            $table->string("notif_title");
            $table->string("desc");
            $table->enum('notif_type', ['update', 'offers']);
            $table->text("content")->collation('utf16_general_ci')->nullable();
            $table->integer("org_id");
            $table->integer("branch_id");
            $table->integer("role_id");
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('admin_notifications');
    }
}
