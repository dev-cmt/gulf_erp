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
        Schema::create('hr_attendances', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->time('in_time')->nullable();
            $table->time('out_time')->nullable();
            $table->tinyInteger('attendance_type')->default(false);
            $table->text('location')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(false);
            $table->tinyInteger('late')->default(false);
            $table->integer('finger_id')->nullable();
            $table->timestamps();
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('emp_id');
            $table->foreign('emp_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hr_attendances');
    }
};
