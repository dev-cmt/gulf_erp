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
        Schema::create('info_personals', function (Blueprint $table) {
            $table->id();
            $table->text('employee_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->integer('employee_gender')->nullable();
            $table->string('nid_no')->nullable();
            $table->integer('blood_group')->nullable();
            $table->string('work_station')->nullable();
            $table->string('number_official')->nullable();
            $table->string('email_official')->nullable();
            $table->date('joining_date')->nullable();
            $table->integer('service_length')->nullable();
            $table->double('gross_salary')->nullable();
            $table->integer('reporting_boss')->nullable();
            $table->integer('district_present')->nullable();
            $table->integer('city_present')->nullable();
            $table->integer('thana_present')->nullable();
            $table->string('zip_code_present')->nullable();
            $table->string('address_present')->nullable();
            
            $table->integer('district_permanent')->nullable();
            $table->integer('city_permanent')->nullable();
            $table->integer('thana_permanent')->nullable();
            $table->string('zip_code_permanent')->nullable();
            $table->string('address_permanent')->nullable();

            $table->bigInteger('passport_no')->nullable();
            $table->string('driving_license')->nullable();
            $table->integer('marital_status')->nullable();
            $table->string('house_phone')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->bigInteger('birth_certificate_no')->nullable();
            $table->string('emg_person_name')->nullable();
            $table->string('emg_phone_number')->nullable();
            $table->string('emg_relationship')->nullable();
            $table->string('emg_address')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('department');
            $table->foreign('department')->references('id')->on('mast_departments')->onDelete('cascade');
            $table->unsignedBigInteger('designation');
            $table->foreign('designation')->references('id')->on('mast_designations')->onDelete('cascade');
            $table->unsignedBigInteger('employee_type');
            $table->foreign('employee_type')->references('id')->on('mast_employee_categories')->onDelete('cascade');
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
        Schema::dropIfExists('info_personals');
    }
};
