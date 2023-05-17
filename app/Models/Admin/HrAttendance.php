<?php


namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\MastLeave;
use App\Models\User;

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

}
