<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\InfoEducational;
use App\Models\Admin\InfoWorkExperience;
use App\Models\User;
use App\Models\Todo;

class InfoRelatedController extends Controller
{
    public function index()
    {
        $user =User::get();
        $educational =InfoEducational::orderBy('id','DESC')->get();
        $work_experience =InfoWorkExperience::orderBy('id','DESC')->get();
        return view('layouts.pages.admin.info_related.create',compact('educational','work_experience','user'));
    }
    public function create()
    {
        $user =User::get();
        return view('layouts.pages.admin.info_related.create',compact('user'));
    }
    public function edit(Todo $todo)
    {
        return response()->json($todo);
    }
    public function store(Request $request) 
    {  
        if($request->institute_name != null){
            $todo= new InfoEducational();
            $todo->qualification=$request->qualification;
            $todo->institute_name=$request->institute_name;
            $todo->passing_year=$request->passing_year;
            $todo->grade=$request->grade;
            $todo->user_id='1';
            $todo->save();
            return response()->json($todo);
        }elseif($request->company_name){
            $todo= new InfoWorkExperience();
            $todo->company_name=$request->company_name;
            $todo->designation=$request->designation;
            $todo->start_date=$request->start_date;
            $todo->end_date=$request->end_date;
            $todo->job_description=$request->job_description;
            $todo->user_id='1';
            $todo->save();
            return response()->json($todo);
        }elseif ($request->bank_name) {
            $todo= new InfoBank();
            $todo->bank_name=$request->bank_name;
            $todo->brance_name=$request->brance_name;
            $todo->acount_name=$request->acount_name;
            $todo->acount_no=$request->acount_no;
            $todo->acount_type=$request->acount_type;
            $todo->bank_name_office=$request->bank_name_office;
            $todo->brance_name_office=$request->brance_name_office;
            $todo->acount_name_office=$request->acount_name_office;
            $todo->acount_no_office=$request->acount_no_office;
            $todo->acount_type_office=$request->acount_type_office;
            $todo->user_id='1';
            $todo->save();
            return response()->json($todo);
        }elseif($request->bank_name){
            $todo= new InfoBank();
            $todo->full_name=$request->full_name;
            $todo->nid_no=$request->nid_no;
            $todo->relation=$request->relation;
            $todo->mobile_no=$request->mobile_no;
            $todo->nominee_percentage=$request->nominee_percentage;
            $todo->profile_image=$request->profile_image;
            $todo->user_id='1';
            $todo->save();
            return response()->json($todo);
        }
        // return response()->json(['success'=>'Work Experience Information save is being processed.']);
    }
    public function destroy($id)
    {
        $data=InfoEducational::find($id);
        $data->delete();
        return response()->json('success');
    }

}
