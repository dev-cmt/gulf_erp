<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Admin\HrAttendance;
use App\Models\Admin\InfoPersonal;
use Illuminate\Auth\Events\Validated;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Support\Facades\Validator;
use DB;
use function PHPUnit\Framework\returnSelf;

class ManualAttendanceController extends Controller
{

    public function index()
    {
        $attendance = HrAttendance::Select('id','emp_id','emp_code','status','date','attendance_type','start_time','end_time','location','message')
        ->with('employee_name:name,id','information:user_id,id',)->where('status',1)
        ->get();

        // $attendance = HrAttendance::Select('id','emp_id','first_name','last_name','date','attendance_type','start_time','end_time')
        //                 ->join('info_personals.id','information:user_id,id',)
        //                 ->with('i.department:dept_name,id')
        //                 ->with('information.designation:desig_name,id')
        //                 ->where('status',0)
        //                 ->get()
        //                 ->toArray();

        // $data =DB::table('users')
        //                 ->join('hr_attendances','hr_attendances.emp_id','users.id')
        //                 ->join('info_personals','info_personals.user_id','users.id')
        //                 ->select('info_personals.first_name','info_personals.last_name','info_personals.employee_id','hr_attendances.start_time')
        //                 ->get();

        // $data =DB::table('hr_attendances')
        // ->join('info_personals','info_personals.user_id','hr_attendances.emp_id')
        // ->where('hr_attendances.status', 0)
        // ->select('info_personals.first_name','info_personals.last_name','info_personals.employee_id','hr_attendances.start_time')
        // ->get();

        return view('layouts.pages.admin.attendance.attendanceList',compact('attendance'));
    }


    public function create()

    {
        $user = User::with('employee_code')->orderBy('id','DESC')->get();

        // $data =DB::table('hr_attendances')
        // ->join('info_personals','info_personals.user_id','hr_attendances.emp_id')
        // ->join('users','info_personals.user_id','users.id')
        // ->select('users.*','info_personals.first_name','info_personals.last_name','info_personals.employee_id','hr_attendances.start_time')
        // ->get();
        return view('layouts.pages.admin.attendance.manualattendance',compact('user'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'employee_name' => 'required',
            'attendance_type' => 'required',
            'location' => 'required',
            'message' => 'required',

        ]);
        HrAttendance::attendanceDataSave($request);

        return redirect()->back();

    }

    public function show($id)
    {
        // $dataShow = HrAttendance::find([$id]);
        // dd($dataShow);

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

    public function getemployeereport($id)
    {
        $attendanceList = HrAttendance::where('emp_id',$id)->get();
        return view('layouts.pages.admin.attendance.attendance-details-view',compact('attendanceList'));
    }



    public function employeeCode(Request $request)
    {
        $employeeCode = InfoPersonal::select('user_id','employee_id')->where('user_id',$request->userId)->first();
        return response()->json($employeeCode);

    }

    //------ Attendance Approve
    public function attendance_approve()
    {
        $attendance = HrAttendance::Select('id','emp_id','emp_code','status','date','attendance_type','start_time','end_time','location','message')->where('status',0)
        ->with('employee_name:name,id','information:user_id,id')
        ->orderBy('id','DESC')
        ->get();



        return view('layouts.pages.admin.attendance.attendanceapprove',compact('attendance'));
    }

    public function approve($id){
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
}


