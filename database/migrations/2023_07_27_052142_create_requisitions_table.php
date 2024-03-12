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
        Schema::create('requisitions', function (Blueprint $table) {
            $table->id();
            $table->string('requ_no')->nullable();
            $table->date('requ_date')->nullable();
            $table->text('remarks')->nullable();
            $table->unsignedBigInteger('complaint_id')->nullable();
            $table->unsignedBigInteger('tech_id');
            $table->tinyInteger('status')->default(false);
            $table->unsignedBigInteger('user_id');

            $table->foreign('tech_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('requisitions');
    }
};
