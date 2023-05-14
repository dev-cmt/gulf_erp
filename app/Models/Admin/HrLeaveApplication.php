<?php

namespace App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\InfoPersonal;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Auth;

class HrLeaveApplication extends Model
{
    use HasFactory;
    protected $fillable = [
        'start_date',
        'end_date',
        'leave_type',
        'leave_contact',
        'leave_location',
        'purpose',
        'status',
        'emp_id',
        'user_id',
    ];

    public function getDurationAttribute()
    {
        $start_date = Carbon::parse($this->attributes['start_date']);
        $end_date = Carbon::parse($this->attributes['end_date']);
        $duration = $end_date->diffInDays($start_date) + 1;
        return $duration . ' days';
    }

}


