<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrAttendance extends Model
{
    use HasFactory;
    public static function attendanceDataSave($request)
    {
        $manualAttendance = new HrAttendance();
        $manualAttendance->employee_name = $request->employee_name;
        $manualAttendance->employee_code = $request->employee_code;
        $manualAttendance->date = $request->date;
        $manualAttendance->attendance_type = $request->attendance_type;
        $manualAttendance->start_time = $request->start_time;
        $manualAttendance->end_time = $request->end_time;
        $manualAttendance->location = $request->location;
        $manualAttendance->status = $request->status;
        $manualAttendance->message = $request->message;
        $manualAttendance->save(); 
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
