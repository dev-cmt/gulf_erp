<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\MastEmployeeType;
use Auth;

class MastEmployeeTypeController extends Controller
{
    public function index() {
        $employee = MastEmployeeType::latest()->get();
        return view('layouts.pages.master.employee_category.index', compact('employee'));
    }

    public function create() {
        return view('layouts.pages.master.employee_category.create');
    }

    public function store(Request $request)
    {

        if (empty($request->cat_name)) {
            $notification = array('messege' => 'Category Name can not left blank', 'alert-type' => 'error');
            return redirect()->back()->with($notification);

        } else  {
            $data = new MastEmployeeType();
            $data->entry_by = Auth::user()->id;
            $data->cat_name =$request->cat_name;
            $data->cat_type =$request->cat_type;

            if(empty($request->description)) {
                $data->description = " ";
            } else {
                $data->description = $request->description;
            }
            $data->status = $request->status;
            $data->save();
            $notification = array('messege' => 'Employee Category data save successfully.', 'alert-type' => 'success');
            return redirect()->route('must_employee_category.index')->with($notification);
        }
    }

    public function edit($id)
    {
        $data = MastEmployeeType::find($id);
        return view('layouts.pages.master.employee_category.edit', compact('data'));
    }
    
    public function update(Request $request, $id)
    {
        if (empty($request->cat_name)) {
            $notification = array('messege' => 'Category Name can not left blank', 'alert-type' => 'error');
            return redirect()->back()->with($notification);

        } else  {
            $data = MastEmployeeType::find($id);
            $data->entry_by = Auth::user()->id;
            $data->cat_name =$request->cat_name;
            $data->cat_type =$request->cat_type;

            if(empty($request->description)) {
                $data->description = " ";
            } else {
                $data->description = $request->description;
            }
            $data->status = $request->status;
            $data->save();
            $notification = array('messege' => 'Employee Category data update successfully.', 'alert-type' => 'success');
            return redirect()->route('must_employee_category.index')->with($notification);
        }
    }

    public function show( $id)
    {
        $data = MastEmployeeType::find($id);
        return view('layouts.pages.master.employee_category.show', compact('data'));
    }
}
