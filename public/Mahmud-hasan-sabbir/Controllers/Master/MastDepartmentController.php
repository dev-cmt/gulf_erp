<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\MastDepartment;

class MastDepartmentController extends Controller
{
    public function index() {
        // ->where('status', 0)->orWhere('status', 1)
        $department = MastDepartment::latest()->get();
        return view('layouts.pages.master.department.index', compact('department'));
    }

    public function create() {
        return view('layouts.pages.master.department.create');
    }

    public function store(Request $request)
    {
        $data = new MastDepartment();
        $data->dept_name =$request->dept_name;
        $data->dept_head =$request->dept_head;
        $data->description =$request->description;
        $data->status =$request->status;
        $data->save();
        $notification=array('messege'=>'Department data save successfully.','alert-type'=>'success');
        return redirect()->route('mast_department.index')->with($notification);
    }

    public function edit($id)
    {
        $data = MastDepartment::find($id);
        return view('layouts.pages.master.department.edit', compact('data'));
    }
    
    public function update(Request $request, $id)
    {
        $data = MastDepartment::find($id);
        $data->dept_name =$request->dept_name;
        $data->dept_head =$request->dept_head;
        $data->description =$request->description;
        $data->status =$request->status;
        $data->save();
        $notification=array('messege'=>'Department data update successfully.','alert-type'=>'success');
        return redirect()->route('mast_department.index')->with($notification);
    }

    public function show( $id)
    {
        $data = MastDepartment::find($id);
        return view('layouts.pages.master.department.show', compact('data'));
    }

}
