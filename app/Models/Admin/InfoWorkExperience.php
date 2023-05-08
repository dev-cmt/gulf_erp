<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoWorkExperience extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_name',
        'designation',
        'start_date',
        'end_date',
        'job_description',
        'status',
        'user_id',
    ];

}
