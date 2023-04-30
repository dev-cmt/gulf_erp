<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\InfoPersonal;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Helpers\Helper;

class InfoPersonalController extends Controller
{
    public function index()
    {
        return view('layouts.pages.admin.info_personal.index');
    }
    public function create()
    {
        return view('layouts.pages.admin.info_personal.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            // 'password' => 'required|min:6|confirmed',
            // 'profile_photo_path' => 'image|mimes:jpg,png,jpeg,gif,svg'
        ]);

        //----------User Create
        if($request->hasFile("profile_photo_path")){
            $file=$request->file("profile_photo_path");
            $imageName=time().'_'.$file->getClientOriginalName();
            $file->move(\public_path("images/profile/"),$imageName);
        }
        $user= new User();
        $user->name= $request->first_name.' '.$request->last_name;
        $user->email= $request->email;
        $user->contact_number=$request->contact_number;
        $user->password=bcrypt('12345678');
        $user->status='1';
        $user->is_admin='1';
        $user->profile_photo_path= $imageName;
        $user->email_verified_at='2023-01-01';
        $user->save();

        //----------Personal Info
        $employee_id = Helper::IDGenerator(new InfoPersonal, 'employee_id', 5, 'GULF'); /* Generate id */
        $user_id = User::orderBy('id', 'desc')->first()->id;

        $data= new InfoPersonal();
        $data->employee_id= $employee_id;
        $data->user_id= $user_id+1;
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
        
        return response()->json(['success'=>'Education information save is being processed.']);
    }
}
