<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\MastEmployeeCategory;

class MastEmployeeCategoryController extends Controller
{
    public function index() {
        $employee = MastEmployeeCategory::latest()->get();
        return view('layouts.pages.master.employee_category.index', compact('employee'));
    }

    public function create() {
        return view('layouts.pages.master.employee_category.create');
    
    }

    public function store(Request $request)
    {
        $data = new MastEmployeeCategory();
        $data->cat_name =$request->cat_name;
        $data->description =$request->description;
        $data->status =$request->status;
        $data->save();
        $notification=array('messege'=>'Employee category data save successfully.','alert-type'=>'success');
        return redirect()->route('must_employee_category.index')->with($notification);
    }

    public function edit($id)
    {
        $data = MastEmployeeCategory::find($id);
        return view('layouts.pages.master.employee_category.edit', compact('data'));
    }
    
    public function update(Request $request, $id)
    {
        $data = MastEmployeeCategory::find($id);
        $data->cat_name =$request->cat_name;
        $data->description =$request->description;
        $data->status =$request->status;
        $data->save();
        $notification=array('messege'=>'Employee category data update successfully.','alert-type'=>'success');
        return redirect()->route('must_employee_category.index')->with($notification);
    }

    public function show( $id)
    {
        $data = MastEmployeeCategory::find($id);
        return view('layouts.pages.master.employee_category.show', compact('data'));
    }
}
