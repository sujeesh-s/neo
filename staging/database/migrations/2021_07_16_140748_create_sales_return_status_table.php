<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesReturnStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_return_status', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sales_id');
            $table->bigInteger('status_id');
            $table->string('desc')->nullable();
            $table->timestamps();
            $table->boolean('is_deleted')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_return_status');
    }
}
