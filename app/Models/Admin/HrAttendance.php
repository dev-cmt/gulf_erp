<?php


namespace App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrAttendance extends Model
{
    use HasFactory;
    public static function attendanceDataSave($request)
    {
        $manualAttendance = new HrAttendance();
        $manualAttendance->emp_id = $request->employee_name;
        $manualAttendance->emp_code = $request->emp_code;
        $manualAttendance->date = $request->date;
        $manualAttendance->attendance_type = $request->attendance_type;
        $manualAttendance->start_time = $request->start_time;
        $manualAttendance->end_time = $request->end_time;
        $manualAttendance->location = $request->location;
        $manualAttendance->message = $request->message;
        $manualAttendance->save();
    }

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
