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
        Schema::create('mast_employee_categories', function (Blueprint $table) {
            $table->id();
            $table->string('cat_name')->nullabale();
            $table->string('cat_type')->nullabale();
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
        Schema::dropIfExists('mast_employee_categories');
    }
};
