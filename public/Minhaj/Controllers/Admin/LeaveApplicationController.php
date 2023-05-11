<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\HrLeaveApplication;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Master\MastDesignation;
use DB;
use Auth;
class LeaveApplicationController extends Controller
{
    public function application()
    {  
        $applicationData = User::with('leaveApplication')->get();
        // info_personals
        // mast_departments
        // mast_designations
        // hr_leave_applications

        // $data = DB::table('users')
        // ->join('hr_leave_applications', 'hr_leave_applications.user_id', '=', 'users.id')
        // ->join('info_personals', 'info_personals.user_id', '=', 'users.id')
        // ->join('mast_designations', 'info_personals.designation', '=', 'mast_designations.id')
        // ->select('users.*','hr_leave_applications.start_date','hr_leave_applications.end_date','mast_designations.desig_name')
        // ->get();

        $data = DB::table('users')
        ->join('hr_leave_applications', 'hr_leave_applications.user_id', '=', 'users.id')
        ->join('info_personals', 'info_personals.user_id', '=', 'users.id')
        ->join('mast_designations', 'info_personals.designation', '=', 'mast_designations.id')
        ->where('users.id', Auth::user()->id)
        ->select('users.*','hr_leave_applications.name','hr_leave_applications.leave_type','hr_leave_applications.start_date','hr_leave_applications.end_date','hr_leave_applications.status',)
        ->get();

        $single_data = DB::table('users')
        ->join('info_personals', 'info_personals.user_id', '=', 'users.id')
        ->join('mast_designations', 'info_personals.designation', '=', 'mast_designations.id')
        ->where('users.id', Auth::user()->id)
        ->select('users.*','mast_designations.desig_name')
        ->first();

        // $comments = DB::table('comments')
        // ->join('posts', 'comments.post_id', '=', 'posts.id')
        // ->join('users', 'posts.user_id', '=', 'users.id')
        // ->where('users.id', $userId)
        // ->select('comments.*')
        // ->get();

        return view('layouts.pages.admin.leave.application',compact('applicationData','data','single_data'));
    }
    public function dept_approve()
    {
        $applicationData = HrLeaveApplication::latest()->where('status', 0)->get();
        return view('layouts.pages.admin.leave.dept_approve', [
            'applicationData'=>$applicationData,
        ]);
    }

    public function hr_approve()
    {
        $applicationData = HrLeaveApplication::latest()->where('status', 1)->get();

        //  $applicationData = HrLeaveApplication::latest()->get();
        return view('layouts.pages.admin.leave.hr_approve', ['applicationData'=>$applicationData,]);
    }

    public function emergency_leave()
    {

        $user = User::with('employeeCode')->orderBy('id','DESC')->get();

        $applicationData = HrLeaveApplication::latest()->get();
        return view('layouts.pages.admin.leave.emergency_leave',[
            'applicationData'=>$applicationData, 
            'user' =>$user, 
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'leave_type' => 'required',
            'leave_location' => 'required',
            'leave_contact' => 'required',
            'purpose' => 'required',
        ]);
        
        HrLeaveApplication::newLeave($request);
        return redirect()->back()->with('message', 'Application Added Successfully.');
    }

    public function approve($id){
        $data = HrLeaveApplication::findOrFail($id);
        $data->status =  $data->status + 1; 
        $data->save();
        return redirect()->back();
    }

    public function decline($id){
        $data = HrLeaveApplication::findOrFail($id);
        $data->status = 3;
        $data->save();
        return redirect()->back();
    }

    public function self_leave()
    {
        return view('layouts.pages.admin.leave.self_leave');
    }

}
