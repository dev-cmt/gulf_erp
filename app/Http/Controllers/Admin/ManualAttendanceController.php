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
        $employee = User::get();
        $data = HrAttendance::paginate(30);
        return view('layouts.pages.admin.attendance.index',compact('data','employee'));

        // $data = User::with('attendance')->where('status', 1)->get();
        // return view('layouts.pages.admin.attendance.index',compact('data'));
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
            'in_time' => 'required',
            'out_time' => 'required',
        ]);
        
        $data = new HrAttendance();
        $data->date = $request->date;
        $data->in_time = $request->in_time;
        $data->out_time = $request->out_time;
        $data->attendance_type = $request->attendance_type;
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
        return view('layouts.pages.admin.attendance.show',compact('data','user'));
    }

    public function filterByDate(Request $request)
    {
        // $startDate = '2022-05-05';
        // $endDate = '2022-05-13';
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        // dd($startDate,$endDate);
        $data = HrAttendance::whereDate('date','>=', $startDate)->whereDate('date','<=', $endDate)->get();

        return redirect()->jeson($startDate);
        // Return the filtered items to the view or perform any other desired action
        return view('barcode', compact('data'));
        // return view('layouts.pages.admin.attendance.index', compact('data'));
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
        $emp_id = 1;
        $file = $request->file('file');

        Excel::import(new AttendanceImport($emp_id), $file);
        // Excel::import(new UsersImport, $request->file);

        $notification=array('messege'=>'Manual attendance successfully!','alert-type'=>'success');
        return redirect()->route('manual_attendances.index')->with($notification);
    }

    public function exportAttendance() 
    {
        return Excel::download(new AttendanceExport, 'Attendance.xlsx');
    }
}


