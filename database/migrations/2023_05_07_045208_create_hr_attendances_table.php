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
            $table->integer('employee_name');
            $table->text('employee_code');
            $table->date('date');
            $table->integer('attendance_type');
            $table->time('start_time');
            $table->time('end_time');
            $table->text('location');
            $table->tinyInteger('status');
            $table->text('message');
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
        Schema::dropIfExists('hr_attendances');
    }
};
