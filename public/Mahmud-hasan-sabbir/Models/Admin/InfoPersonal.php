<?php

namespace App\Models\Admin;

use App\Models\Master\MastDepartment;
use App\Models\Master\MastDesignation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoPersonal extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'first_name',
        'last_name',
        'date_of_birth',
        'employee_gender',
        'nid_no',
        'blood_group',
        'department',
        'designation',
        'employee_type',
        'work_station',
        'number_official',
        'email_official',
        'joining_date',
        'service_length',
        'gross_salary',
        'reporting_boss',
        'district_present',
        'city_present',
        'thana_present',
        'zip_code_present',
        'address_present',
        'district_permanent',
        'city_permanent',
        'thana_permanent',
        'zip_code_permanent',
        'address_permanent',
        'passport_no',
        'driving_license',
        'marital_status',
        'house_phone',
        'father_name',
        'mother_name',
        'birth_certificate_no',
        'emg_person_name',
        'emg_phone_number',
        'emg_relationship',
        'emg_address',
    ];

    public function department()
    {
        return $this->hasOne(MastDepartment::class,'id','department');
    }

    public function designation()
    {
        return $this->hasOne(MastDesignation::class,'id','designation');
    }

}
