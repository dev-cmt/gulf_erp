<?php
namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\MastDesignation;
use Auth;

class MastDesignationController extends Controller
{
    public function index() {
        $designation = MastDesignation::latest()->get();
        return view('layouts.pages.master.designation.index', compact('designation'));
    }

    public function create() {
        return view('layouts.pages.master.designation.create');
    }

    public function store(Request $request)
    {

        // $data = new MastDesignation();
        // $data->desig_name =$request->desig_name;
        // $data->description =$request->description;
        // $data->status =$request->status;
        // $data->save();
        // $notification=array('messege'=>'Designation data save successfully.','alert-type'=>'success');
        // return redirect()->route('mast_designation.index')->with($notification);

        if (empty($request->desig_name)) {
            $notification = array('messege' => 'Designation Name can not left blank', 'alert-type' => 'error');
            return redirect()->back()->with($notification);

        } else  {
            $data = new MastDesignation();
            $data->entry_by = Auth::user()->id;
            $data->desig_name = $request->desig_name;

            if(empty($request->description)) {
                $data->description = " ";
            } else {
                $data->description = $request->description;
            }
            $data->status = $request->status;
            $data->save();
            $notification = array('messege' => 'Designation data save successfully.', 'alert-type' => 'success');
            return redirect()->route('mast_designation.index')->with($notification);
        }
    }

    public function edit($id)
    {
        $data = MastDesignation::find($id);
        return view('layouts.pages.master.designation.edit', compact('data'));
    }
    
    public function update(Request $request, $id)
    {
        if (empty($request->desig_name)) {
            $notification = array('messege' => 'Designation Name can not left blank', 'alert-type' => 'error');
            return redirect()->back()->with($notification);

        } else  {
            $data = MastDesignation::find($id);
            $data->entry_by = Auth::user()->id;
            $data->desig_name = $request->desig_name;

            if(empty($request->description)) {
                $data->description = " ";
            } else {
                $data->description = $request->description;
            }
            $data->status = $request->status;
            $data->save();
            $notification = array('messege' => 'Designation data update successfully.', 'alert-type' => 'success');
            return redirect()->route('mast_designation.index')->with($notification);
        }
    }

    public function show( $id)
    {
        $data = MastDesignation::find($id);
        return view('layouts.pages.master.designation.show', compact('data'));
    }
}
