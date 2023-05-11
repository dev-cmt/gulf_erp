<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\MastLeave;
use Auth;

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
        if (empty($request->leave_name)) {
            $notification = array('messege' => 'Leave Name can not left blank', 'alert-type' => 'error');
            return redirect()->back()->with($notification);

        } else if (empty($request->max_limit)) {
            $notification = array('messege' => 'Max Limit can not left blank', 'alert-type' => 'error');
            return redirect()->back()->with($notification);

        } else if (empty($request->leave_code)) {
            $notification = array('messege' => 'Leave code can not left blank', 'alert-type' => 'error');
            return redirect()->back()->with($notification);

        } else if (empty($request->yearly_limit)) {
            $notification = array('messege' => 'Yearly Limit can not left blank', 'alert-type' => 'error');
            return redirect()->back()->with($notification);

        } else  {
            $data = new MastLeave();
            $data->entry_by = Auth::user()->id;
            $data->leave_name =$request->leave_name;
            $data->max_limit =$request->max_limit;
            $data->leave_code =$request->leave_code;
            $data->yearly_limit =$request->yearly_limit;

            if(empty($request->description)) {
                $data->description = " ";
            } else {
                $data->description = $request->description;
            }
            $data->status = $request->status;
            $data->save();
            $notification = array('messege' => 'Leave type data save successfully.', 'alert-type' => 'success');
            return redirect()->route('mast_leave.index')->with($notification);
        }
    }

    public function edit($id)
    {
        $data = MastLeave::find($id);
        return view('layouts.pages.master.leave_type.edit', compact('data'));
    }
    
    public function update(Request $request, $id)
    {
        if (empty($request->leave_name)) {
            $notification = array('messege' => 'Leave Name can not left blank', 'alert-type' => 'error');
            return redirect()->back()->with($notification);

        } else if (empty($request->max_limit)) {
            $notification = array('messege' => 'Max Limit can not left blank', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
            
        } else if (empty($request->leave_code)) {
            $notification = array('messege' => 'Leave code can not left blank', 'alert-type' => 'error');       
            return redirect()->back()->with($notification);

        } else if (empty($request->yearly_limit)) {
            $notification = array('messege' => 'Yearly Limit can not left blank', 'alert-type' => 'error');
            return redirect()->back()->with($notification);

        } else  {
            $data = MastLeave::find($id);
            $data->entry_by = Auth::user()->id;
            $data->leave_name =$request->leave_name;
            $data->max_limit =$request->max_limit;
            $data->leave_code =$request->leave_code;
            $data->yearly_limit =$request->yearly_limit;

            if(empty($request->description)) {
                $data->description = " ";
            } else {
                $data->description = $request->description;
            }
            $data->status = $request->status;
            $data->save();
            $notification = array('messege' => 'Leave data update successfully.', 'alert-type' => 'success');
            return redirect()->route('mast_leave.index')->with($notification);
        }
    }

    public function show( $id)
    {
        $data = MastLeave::find($id);
        return view('layouts.pages.master.leave_type.show', compact('data'));
    }
}
