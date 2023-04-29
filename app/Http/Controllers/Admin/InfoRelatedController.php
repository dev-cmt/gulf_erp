<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\InfoEducational;

class InfoRelatedController extends Controller
{
    public function create()
    {
        return view('layouts.pages.admin.info_related.create');
    }

    public function store(Request $request) 
    {
    	// $data = $request->validate([
        //     'qualification' => 'required',
        //     'institute_name' => 'required',
        // ]);
        // $project = InfoEducational::create($data);

        $data= new InfoEducational();
        $data->qualification=$request->qualification;
        $data->institute_name=$request->institute_name;
        $data->passing_year=$request->passing_year;
        $data->grade=$request->grade;
        $data->save();
        
        return response()->json(['success'=>'Education information save is being processed.']);
    }
}
