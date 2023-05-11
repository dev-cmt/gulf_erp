<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\MastLeave;

class MastLeaveController extends Controller
{
    public function index() {
        $leave = MastLeave::latest()->get();
        return view('layouts.pages.master.leave_type.index', compact('leave'));
    }

    public function create() {
        return view('layouts.pages.master.leave_type.create');
    
    }

    public function store(Request $request)
    {
        $data = new MastLeave();
        $data->leave_name =$request->leave_name;
        $data->max_limit =$request->max_limit;
        $data->leave_code =$request->leave_code;
        $data->yearly_limit =$request->yearly_limit;
        $data->description =$request->description;
        $data->status =$request->status;
        $data->save();
        $notification=array('messege'=>'Leave data save successfully.','alert-type'=>'success');
        return redirect()->route('mast_leave.index')->with($notification);
    }

    public function edit($id)
    {
        $data = MastLeave::find($id);
        return view('layouts.pages.master.leave_type.edit', compact('data'));
    }
    
    public function update(Request $request, $id)
    {
        $data = MastLeave::find($id);
        $data->leave_name =$request->leave_name;
        $data->max_limit =$request->max_limit;
        $data->leave_code =$request->leave_code;
        $data->yearly_limit =$request->yearly_limit;
        $data->description =$request->description;
        $data->status =$request->status;
        $data->save();
        $notification=array('messege'=>'Leave data update successfully.','alert-type'=>'success');
        return redirect()->route('mast_leave.index')->with($notification);
    }

    public function show( $id)
    {
        $data = MastLeave::find($id);
        return view('layouts.pages.master.leave_type.show', compact('data'));
    }
}
