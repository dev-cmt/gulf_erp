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
        Schema::create('service_bill_details', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable();
            $table->integer('qty')->nullable();
            $table->decimal('price')->nullable();
            $table->decimal('total')->nullable();

            $table->unsignedBigInteger('service_bill_id')->nullable();
            $table->foreign('service_bill_id')->references('id')->on('service_bills')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->tinyInteger('status')->default(false);
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
        Schema::dropIfExists('service_bill_details');
    }
};
