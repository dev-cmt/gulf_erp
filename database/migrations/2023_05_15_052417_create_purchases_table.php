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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->date('inv_date')->nullable();
            $table->string('inv_no')->nullable();
            $table->text('remarks')->nullable();
            $table->integer('mast_item_category_id')->nullable();
            $table->tinyInteger('status')->default(false);
            $table->tinyInteger('is_parsial')->default(false);

            $table->unsignedBigInteger('mast_work_station_id');
            $table->foreign('mast_work_station_id')->references('id')->on('mast_work_stations')->onDelete('cascade');
            $table->unsignedBigInteger('mast_supplier_id');
            $table->foreign('mast_supplier_id')->references('id')->on('mast_suppliers')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('purchases');

    }
};
