<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisition_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('requisition_id');
            $table->unsignedBigInteger('mast_item_category_id');
            $table->unsignedBigInteger('mast_item_group_id');
            $table->unsignedBigInteger('mast_item_register_id');
            $table->integer('qty')->nullable();
            $table->integer('rcv_qty')->nullable();
            $table->tinyInteger('status')->default(false);
            $table->unsignedBigInteger('user_id');

            $table->foreign('requisition_id')->references('id')->on('requisitions')->onDelete('cascade');
            $table->foreign('mast_item_category_id')->references('id')->on('mast_item_categories')->onDelete('cascade');
            $table->foreign('mast_item_group_id')->references('id')->on('mast_item_groups')->onDelete('cascade');
            $table->foreign('mast_item_register_id')->references('id')->on('mast_item_registers')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('requisition_details');
    }
};
