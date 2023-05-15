<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\HrLeaveApplication;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Master\MastDesignation;
use App\Models\Master\MastLeave;
use DB;
use Auth;
use DateTime;
class LeaveApplicationController extends Controller
{
    public function leave_application()
    {  
        $data = HrLeaveApplication::join('users', 'users.id', 'hr_leave_applications.user_id')
        ->join('info_personals', 'info_personals.user_id', 'users.id')
        ->join('mast_designations', 'info_personals.designation', 'mast_designations.id')
        ->join('mast_leaves', 'hr_leave_applications.leave_type', 'mast_leaves.id')
        ->where('hr_leave_applications.emp_id', Auth::user()->id)
        ->select('hr_leave_applications.*','users.name','mast_designations.desig_name','mast_leaves.leave_name')
        ->get();

        $leave_type =MastLeave::get();
        return view('layouts.pages.admin.leave.application',compact('leave_type','data'));
    }
    public function emergency_leave()
    {
        $leave_type =MastLeave::get();
        $employee =User::get();
        return view('layouts.pages.admin.leave.emergency_leave',compact('leave_type','employee'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => 'required',
            'end_date' => 'required',
            'leave_type' => 'required',
            'leave_contact' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = new HrLeaveApplication();
        $data->start_date = $request->start_date;
        $data->end_date = $request->end_date;
        $data->leave_type = $request->leave_type;
        $data->leave_contact = $request->leave_contact;
        $data->leave_location = $request->leave_location;
        $data->purpose = $request->purpose;
        $data->user_id = Auth::user()->id;
        $data->emp_id = $request->emp_id;
        $data->save();
        
        //----Leave Name
        $leave_data =MastLeave::where('id', $request->leave_type)->first();
        $data->name =$request->employee_name;
        $data->leave_name =$leave_data->leave_name;
        //----Date Formate
        $date1 = Carbon::createFromFormat('Y-m-d', $request->start_date);
        $date2 = Carbon::createFromFormat('Y-m-d', $request->end_date);
        $data->formattedDate1 = $date1->format('j F, Y');
        $data->formattedDate2 = $date2->format('j F, Y');
        //----Duration Single
        $startDate = new DateTime($request->start_date);
        $endDate = new DateTime($request->end_date);
        $interval = $startDate->diff($endDate);
        $data->duration = $interval->format('%d days');

        return response()->json($data);
    }

    public function dept_approve_list()
    {
        $data = HrLeaveApplication::join('users', 'users.id', 'hr_leave_applications.user_id')
        ->join('info_personals', 'info_personals.user_id', 'users.id')
        ->join('mast_designations', 'info_personals.designation', 'mast_designations.id')
        ->join('mast_leaves', 'hr_leave_applications.leave_type', 'mast_leaves.id')
        ->where('hr_leave_applications.status', 0 )
        ->select('hr_leave_applications.*','users.name','mast_designations.desig_name','mast_leaves.leave_name')
        ->get();

        return view('layouts.pages.admin.leave.approve_dept',compact('data'));
    }
    public function dept_approve($id)
    {
        $data = HrLeaveApplication::findOrFail($id);
        $data->status = '1';
        $data->save();

        $notification=array('messege'=>'Leave approve successfully!','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
    public function hr_approve_list()
    {
        $data = HrLeaveApplication::join('users', 'users.id', 'hr_leave_applications.user_id')
        ->join('info_personals', 'info_personals.user_id', 'users.id')
        ->join('mast_designations', 'info_personals.designation', 'mast_designations.id')
        ->join('mast_leaves', 'hr_leave_applications.leave_type', 'mast_leaves.id')
        ->where('hr_leave_applications.status', 1 )
        ->select('hr_leave_applications.*','users.name','mast_designations.desig_name','mast_leaves.leave_name')
        ->get();

        return view('layouts.pages.admin.leave.approve_hr',compact('data'));
    }
    public function hr_approve($id)
    {
        $data = HrLeaveApplication::findOrFail($id);
        $data->status = 2;
        $data->save();

        $notification=array('messege'=>'Leave approve successfully!','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function decline($id){
        $data = HrLeaveApplication::findOrFail($id);
        $data->status = 3;
        $data->save();

        $notification=array('messege'=>'Canceled successfully!','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function getEmployeeCode(Request $request)
    {
        $employeeCode = User::where('id', $request->userId)->first();
        return response()->json($employeeCode);
    }
}
