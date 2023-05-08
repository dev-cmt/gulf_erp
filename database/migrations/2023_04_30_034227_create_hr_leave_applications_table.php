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
        Schema::create('hr_leave_applications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('designation');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('leave_type');
            $table->string('leave_contact');
            $table->string('leave_location');
            $table->string('purpose');
            $table->integer('status')->default(false);
            $table->integer('dept_approve')->default(false);
            $table->integer('hr_approve')->default(false);
//            $table->string('duration');
//            $table->string('status');
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
        Schema::dropIfExists('hr_leave_applications');
    }
};
