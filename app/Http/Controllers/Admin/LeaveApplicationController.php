<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\HrLeaveApplication;
use Illuminate\Http\Request;
use Carbon\Carbon;


class LeaveApplicationController extends Controller
{
    public function application()
    {
        $applicationData = HrLeaveApplication::latest()->get();
        return view('layouts.pages.admin.leave.application',['applicationData'=>$applicationData,]);
    }
    public function dept_approve()
    {
        $applicationData = HrLeaveApplication::latest()->get();
        return view('layouts.pages.admin.leave.dept_approve', [
            'applicationData'=>$applicationData,
        ]);
    }

    public function hr_approve()
    {
        $applicationData = HrLeaveApplication::latest()->where('status', 1)->orWhere('status', 2)->get();
        return view('layouts.pages.admin.leave.hr_approve', ['applicationData'=>$applicationData,]);
    }

    public function emergency_leave()
    {
        $ecommittee = HrLeaveApplication::all();
        return view('layouts.pages.admin.leave.emergency_leave',compact('ecommittee'));
    }

    public function store(Request $request)
    {
        HrLeaveApplication::newLeave($request);
        return redirect()->back()->with('message', 'Application Added Successfully.');
    }

    public function approve($id){
        $data = HrLeaveApplication::findOrFail($id);
        $data->status = 1;
        $data->save();
        return redirect()->back();
    }

    public function decline($id){
        $data = HrLeaveApplication::findOrFail($id);
        $data->status = 0;
        $data->save();
        return redirect()->back();
    }
}
