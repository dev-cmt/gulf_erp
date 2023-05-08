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
        Schema::create('mast_leaves', function (Blueprint $table) {
            $table->id();
            $table->string('leave_name')->nullabale();
            $table->integer('leave_code')->nullabale();
            $table->integer('max_limit')->nullabale();
            $table->integer('yearly_limit')->nullabale();
            $table->text('description')->nullabale();
            $table->integer('status')->default(false);
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
        Schema::dropIfExists('mast_leaves');
    }
};
