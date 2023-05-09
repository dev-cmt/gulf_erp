<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\Admin\InfoPersonal;
use App\Models\Admin\InfoEducational;
use App\Models\Admin\InfoWorkExperience;
use App\Models\Master\MastDepartment;
use App\Models\Master\MastDesignation;
use App\Models\Master\MastEmployeeCategory;
use App\Models\User;
use App\Helpers\Helper;
use DB;

class InfoEmployeeController extends Controller
{
    public function index()
    {
        $user = User::get();
        return view('layouts.pages.admin.info_employee.index',compact('user'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:80',
            'email' => 'required|email|unique:users,email',
            // 'password' => 'required|min:6|confirmed',
        ]);

        $user= new User();
        $user->name= $request->name;
        $user->email= $request->email;
        $user->contact_number=$request->contact_number;
        $user->password=bcrypt($request->password);
        $user->status='1';
        $user->is_admin='0';
        $user->email_verified_at='2023-01-01';
        $user->save();

        $notification=array('messege'=>'User created successfully!','alert-type'=>'success');
        return back()->with($notification);
    }
    public function personal_create($id){
        $data = DB::table('divisions')->get();
        $divisions = DB::table('divisions')->count('id');
        $districts = DB::table('districts')->count('id');
        $upazilas = DB::table('upazilas')->count('id');
        $unions = DB::table('unions')->count('id');

        $data = [
            'division' => $divisions,
            'divisions' => $data,
            'district' => $districts,
            'upazila' => $upazilas,
            'union' => $unions,
        ];
        $user_id = $id;
        $department =MastDepartment::get();
        $designation =MastDesignation::get();
        $employee_category =MastEmployeeCategory::get();

        return view('layouts.pages.admin.info_employee.info_personal',compact('data','user_id','department','designation','employee_category'));
    }
    public function personal_store(Request $request, $id)
    {
        //----------User Create
        $user = User::findorfail($id);
        if($request->hasFile("profile_photo_path")){
            if (File::exists("images/profile/".$user->profile_photo_path)) {
                File::delete("images/profile/".$user->profile_photo_path);
            }
            $file=$request->file("profile_photo_path");
            $imageName=time()."_".$file->getClientOriginalName();
            $file->move(\public_path("images/profile/"),$imageName);
            $request['profile_photo_path']=$imageName;
        }
        $user->update([
            'profile_photo_path' => $imageName,
        ]);

        //----------Personal Info
        $employee_id = Helper::IDGenerator(new InfoPersonal, 'employee_id', 5, 'GULF'); /* Generate id */

        $data= new InfoPersonal();
        $data->employee_id= $employee_id;
        $data->user_id= $id;
        $data->first_name=$request->first_name;
        $data->last_name=$request->last_name;
        
        $data->date_of_birth=$request->date_of_birth;
        $data->employee_gender=$request->employee_gender;
        $data->nid_no=$request->nid_no;
        $data->blood_group=$request->blood_group;
        $data->department=$request->department;
        $data->designation=$request->designation;
        $data->employee_type=$request->employee_type;
        $data->work_station=$request->work_station;

        $data->number_official=$request->number_official;
        $data->email_official=$request->email_official;
        $data->joining_date=$request->joining_date;
        $data->service_length=$request->service_length;
        $data->gross_salary=$request->gross_salary;
        $data->reporting_boss=$request->reporting_boss;
        $data->district_present=$request->district_present;
        $data->city_present=$request->city_present;
        $data->thana_present=$request->thana_present;
        $data->zip_code_present=$request->zip_code_present;
        $data->address_present=$request->address_present;
        $data->district_permanent=$request->district_permanent;
        $data->city_permanent=$request->city_permanent;
        $data->thana_permanent=$request->thana_permanent;
        $data->zip_code_permanent=$request->zip_code_permanent;
        $data->address_permanent=$request->address_permanent;

        $data->passport_no=$request->passport_no;
        $data->driving_license=$request->driving_license;
        $data->marital_status=$request->marital_status;
        $data->house_phone=$request->house_phone;
        $data->father_name=$request->father_name;
        $data->mother_name=$request->mother_name;
        $data->birth_certificate_no=$request->birth_certificate_no;
        $data->emg_person_name=$request->emg_person_name;
        $data->emg_phone_number=$request->emg_phone_number;
        $data->emg_relationship=$request->emg_relationship;
        $data->emg_address=$request->emg_address;
        $data->save();
        
        $notification=array('messege'=>'Category save successfully!','alert-type'=>'success');
        return redirect()->route('info_employee_related.create', $id)->with($notification);
    }


    public function related_create($id)
    {
        $user =User::findorfail($id);
        $educational =InfoEducational::orderBy('id','DESC')->where('user_id', $id)->get();
        $work_experience =InfoWorkExperience::orderBy('id','DESC')->where('user_id', $id)->get();
        $user_id = $id;
        return view('layouts.pages.admin.info_employee.info_related',compact('user','educational','work_experience','user_id'));
    }

    public function related_store(Request $request, $id) 
    {  

        if($request->institute_name != null){
            $todo= new InfoEducational();
            $todo->qualification=$request->qualification;
            $todo->institute_name=$request->institute_name;
            $todo->passing_year=$request->passing_year;
            $todo->grade=$request->grade;
            $todo->user_id= $id;
            $todo->save();
            return response()->json($todo);
        }elseif($request->company_name){
            $todo= new InfoWorkExperience();
            $todo->company_name=$request->company_name;
            $todo->designation=$request->designation;
            $todo->start_date=$request->start_date;
            $todo->end_date=$request->end_date;
            $todo->job_description=$request->job_description;
            $todo->user_id= $id;
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
            $todo->user_id= $id;
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
            $todo->user_id= $id;
            $todo->save();
            return response()->json($todo);
        }
        // return response()->json(['success'=>'Work Experience Information save is being processed.']);
    }
    public function related_education_destroy($id)
    {
        $data = DB::table('info_educationals')->where('id',$id)->delete();

        // $data=InfoEducational::find($id);
        // $data->delete();
        return response()->json('success');
    }
}
