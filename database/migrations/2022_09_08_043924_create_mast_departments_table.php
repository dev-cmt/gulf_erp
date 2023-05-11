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
        Schema::create('mast_departments', function (Blueprint $table) {
            $table->id();
            $table->string('dept_name')->nullabale();
            $table->integer('dept_head')->default(false);
            $table->text('description')->nullabale();
            $table->integer('status')->default(false);
            $table->integer('entry_by')->default(false);
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
        Schema::dropIfExists('mast_departments');
    }
};
