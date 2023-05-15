<?php


namespace App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrAttendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'attendance_type',
        'start_time',
        'end_time',
        'location',
        'description',
        'status',
        'emp_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function employ_code()
    {
        return $this->hasOne(InfoPersonal::class,'user_id','emp_id');
    }

    public function information()
    {
        return $this->hasOne(InfoPersonal::class,'user_id','emp_id');
    }
    public function employee_name()
    {
        return $this->hasOne(User::class,'id','emp_id');
    }

}
