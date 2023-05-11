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
        Schema::create('info_banks', function (Blueprint $table) {
            $table->id();
            $table->string('bank_name')->nullable();
            $table->string('brance_name')->nullable();
            $table->string('acount_name')->nullable();
            $table->integer('acount_no')->nullable();
            $table->integer('acount_type')->nullable();
            
            $table->string('bank_name_office')->nullable();
            $table->string('brance_name_office')->nullable();
            $table->string('acount_name_office')->nullable();
            $table->integer('acount_no_office')->nullable();
            $table->integer('acount_type_office')->nullable();
            $table->tinyInteger('status')->default(false);
            $table->timestamps();
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_banks');
    }
};