<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Admin\HrAttendance;
use App\Models\Admin\InfoPersonal;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AttendanceExport;
use App\Imports\AttendanceImport;
use App\Imports\UsersImport;

class ManualAttendanceController extends Controller
{
    public function index()
    {
        $data = User::with('attendance')->where('status', 1)->get();
        return view('layouts.pages.admin.attendance.index',compact('data'));
    }
    public function create()
    {
        $employee = User::get();
        return view('layouts.pages.admin.attendance.create',compact('employee'));
    }
    public function store(Request $request)
    {
        $validated=$request -> validate([
            'date' => 'date',
            'attendance_type' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);
        
        $data = new HrAttendance();
        $data->date = $request->date;
        $data->attendance_type = $request->attendance_type;
        $data->start_time = $request->start_time;
        $data->end_time = $request->end_time;
        $data->location = $request->location;
        $data->description = $request->description;
        $data->emp_id = $request->emp_id;
        $data->user_id = Auth::user()->id;
        $data->save();

        $notification=array('messege'=>'Manual attendance successfully!','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    //------ Attendance Approve
    public function attendance_approve_list()
    {
        $data = HrAttendance::with('user')->where('status', 0)->get();
        return view('layouts.pages.admin.attendance.approve_attendance',compact('data'));
    }

    public function attendance_approve($id)
    {
        $data = HrAttendance::findOrFail($id);
        $data->status = 1;
        $data->save();
        return redirect()->back();
    }
    public function decline($id){
        $data = HrAttendance::findOrFail($id);
        $data->status = 2;
        $data->save();
        return redirect()->back();

    }

    //---View Attendance List
    public function getemployee_report($id)
    {
        $data = HrAttendance::where('emp_id', $id)->get();
        $user = User::where('id', $id)->first();
        return view('layouts.pages.admin.attendance.attendance-details-view',compact('data','user'));
    }

    /*____________________________________
                Upload EXCEL
    _____________________________________*/
    public function importAttendance()
    {
        return view('layouts.pages.admin.attendance.import');
    }

    public function uploadAttendance(Request $request)
    {
        Excel::import(new AttendanceImport, $request->file);
        // Excel::import(new UsersImport, $request->file);

        $notification=array('messege'=>'Manual attendance successfully!','alert-type'=>'success');
        return redirect()->route('manual_attendances.index')->with($notification);
    }

    public function exportAttendance() 
    {
        return Excel::download(new AttendanceExport, 'Attendance.xlsx');
    }
}


