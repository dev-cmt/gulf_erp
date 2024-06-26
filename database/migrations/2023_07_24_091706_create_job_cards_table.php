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
            $table->date('date')->nullable();
            $table->time('in_time')->nullable();
            $table->time('out_time')->nullable();
            $table->tinyInteger('is_tools')->default(false);
            $table->tinyInteger('is_spare_parts')->default(false);
            $table->tinyInteger('is_next_visit')->default(false);
            $table->tinyInteger('is_complete')->default(false);
            $table->text('note')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('complaint_id')->nullable();
            $table->foreign('complaint_id')->references('id')->on('complaints')->onDelete('cascade');
            $table->unsignedBigInteger('tech_id')->nullable();
            $table->foreign('tech_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('job_cards');
    }
};
