<?php

namespace App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\InfoPersonal;
use Auth;

class HrLeaveApplication extends Model
{
    use HasFactory;
    public static $leave;

    public static function newLeave($request)
    {
        $leave = new HrLeaveApplication();
        $leave->name = $request->name;
        $leave->start_date = $request->start_date;
        $leave->end_date = $request->end_date;
        $leave->leave_type = $request->leave_type;
        $leave->leave_contact = $request->leave_contact;
        $leave->leave_location = $request->leave_location;
        $leave->purpose = $request->purpose;
//        $leave->status = $request->status;
//        $leave->dept_approve = $request->dept_approve;
//        $leave->hr_approve = $request->hr_approve;

//        $leave->duration = $request->duration;
//        $leave->status = $request->status;
        $leave->user_id = Auth::user()->id;
        $leave->save();
        
    }


    // public function user()
    // {
    //     return $this->hasOne(User::class, 'id');
    // }


    public function user()
    {
        return $this->hasOne(User::class);
    }
    public function info_personal()
    {
        return $this->hasOne(InfoPersonal::class);
    }

    public function information()
    {
        return $this->hasOne(information::class, 'user_id', 'id');
    }

    
}


