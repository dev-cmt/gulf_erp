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
        Schema::create('job_cards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tracking_no')->nullable();
            $table->foreign('tracking_no')->references('id')->on('complaints')->onDelete('cascade');
            $table->date('job_date')->nullable();
            $table->tinyInteger('is_next_visit')->default(false);
            $table->date('next_date')->nullable();
            $table->tinyInteger('is_complete')->default(false);
            $table->tinyInteger('is_spare_parts')->nullable();
            $table->text('note')->nullable();
            $table->unsignedBigInteger('tech_id')->nullable;
            $table->text('observe_details')->nullable();
            $table->foreign('tech_id')->references('id')->on('info_personals')->onDelete('cascade');
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
        Schema::dropIfExists('job_cards');
    }
};
