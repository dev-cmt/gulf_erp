<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Admin\HrAttendance;

class ManualAttendanceController extends Controller
{

    public function index()
    {
        $attendance = HrAttendance::all();
        return view('layouts.pages.admin.attendance.attendanceList',compact('attendance'));
    }

    
    public function create()
    {
        $user = User::orderBy('id','DESC')->get();
        return view('layouts.pages.admin.attendance.manualattendance',compact('user'));
    }

    public function store(Request $request)
    {
        HrAttendance::attendanceDataSave($request);
        return redirect()->back();

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    //------ Attendance Approve
    public function attendance_approve()
    {
        return view('layouts.pages.admin.attendance.attendanceapprove');
    }
}


