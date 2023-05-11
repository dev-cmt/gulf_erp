<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\MastDepartment;

use App\Models\User;
use Auth;

class MastDepartmentController extends Controller
{
    public function index() {
        $department = MastDepartment::with('user')->latest()->get();
        $department = MastDepartment::latest()->get();
        return view('layouts.pages.master.department.index', compact('department'));
    }

    public function create() {
        $data = User::orderBy('id','DESC')->get();
        return view('layouts.pages.master.department.create', compact('data'));
    }

    public function store(Request $request)
    {
        if (empty($request->dept_name)) {
            $notification = array('messege' => 'Department Name can not left blank', 'alert-type' => 'error');
            return redirect()->back()->with($notification);

        } else if (empty($request->dept_head)) {
            $notification = array('messege' => 'Department Head not selected', 'alert-type' => 'error');
            return redirect()->back()->with($notification); 

        } else  {
            $data = new MastDepartment();
            $data->entry_by = Auth::user()->id;
            $data->dept_name = $request->dept_name;
            if(empty($request->description)) {
                $data->description = " ";
            } else {
                $data->description = $request->description;
            }
            $data->dept_head = $request->dept_head;
            $data->status = $request->status;
            $data->save();
            $notification = array('messege' => 'Department data save successfully.', 'alert-type' => 'success');
            return redirect()->route('mast_department.index')->with($notification);
        } 
    }

    public function edit($id)
    {
        $data = MastDepartment::find($id);
        $users = User::orderBy('id','DESC')->get();
        return view('layouts.pages.master.department.edit', compact('data', 'users'));
    }
    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'dept_head' => 'required'
        ]);
        
        if (empty($request->dept_name)) {
            $notification = array('messege' => 'Department Name can not left blank', 'alert-type' => 'error');
        
            return redirect()->back()->with($notification);
        } else if (empty($request->dept_head)) {
            $notification = array('messege' => 'Department Head not selected', 'alert-type' => 'error');
        
            return redirect()->back()->with($notification);
        } else  {
            $data = MastDepartment::find($id);
            $data->entry_by = Auth::user()->id;
            $data->dept_name = $request->dept_name;
            if(empty($request->description)) {
                $data->description = " ";
            } else {
                $data->description = $request->description;
            }
            $data->dept_head = $request->dept_head;
            $data->status = $request->status;
        
            $data->save();
        
            $notification = array('messege' => 'Department data update successfully.', 'alert-type' => 'success');
        
            return redirect()->route('mast_department.index')->with($notification);
        } 
    }

    public function show( $id)
    {

        // $data = MastDepartment::find($id);
        $data = MastDepartment::with('user')->find($id);
        $data = MastDepartment::find($id);
        return view('layouts.pages.master.department.show', compact('data'));
    }

}
