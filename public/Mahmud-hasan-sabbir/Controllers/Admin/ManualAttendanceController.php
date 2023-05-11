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

        $data =DB::table('hr_attendances')
        ->join('info_personals','info_personals.user_id','hr_attendances.emp_id')
        ->where('hr_attendances.status', 0)
        ->select('info_personals.first_name','info_personals.last_name','info_personals.employee_id','hr_attendances.start_time')
        ->get();
            
        return view('layouts.pages.admin.attendance.attendanceList',compact('data'));
    }

    
    public function create()

    {
        $data =DB::table('hr_attendances')
        ->join('info_personals','info_personals.user_id','hr_attendances.emp_id')
        ->join('users','info_personals.user_id','users.id')
        ->select('users.*','info_personals.first_name','info_personals.last_name','info_personals.employee_id','hr_attendances.start_time')
        ->get();
        return view('layouts.pages.admin.attendance.manualattendance',compact('data'));
    }

    public function store(Request $request)
    {

    //    $validated = $request->validate([ 
    //     'message' => 'required',
    //     'status' => 'required',
    //     'end_time' => 'required',
    //     'location' => 'required',
    //     'start_time' => 'required',
    //     'employee_name' => 'required',
        

    //    ]);

        $this->validate($request,[
            'emp_id' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'location' => 'required',
            'attendance_type' => 'required',
            'end_time' => 'required',
            'message' => 'required'
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

    // public function showdata($id)
    // {
    //     $dataShow = HrAttendance::find($id);
    //     dd($dataShow);
    // }

    public function employeeCode(Request $request)
    {
        $employeeCode = InfoPersonal::select('user_id','employee_id')->where('user_id',$request->userId)->first();
        return response()->json($employeeCode);
        
    }

    //------ Attendance Approve
    public function attendance_approve()
    {
        $attendance = HrAttendance::Select('id','employee_name','employee_code','status')
        ->with('employ_name:name,id','information:user_id,id',)
        ->with('information.department:dept_name,id')
        ->with('information.designation:desig_name,id')
        ->get()
        ->toArray();

        
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


