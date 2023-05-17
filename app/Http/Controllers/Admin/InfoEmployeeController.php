<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Models\Admin\InfoPersonal;
use App\Models\Admin\InfoEducational;
use App\Models\Admin\InfoWorkExperience;
use App\Models\Admin\InfoBank;
use App\Models\Admin\InfoNominee;
use App\Models\Master\MastDepartment;
use App\Models\Master\MastDesignation;
use App\Models\Master\MastEmployeeCategory;
use App\Models\User;
use App\Helpers\Helper;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use DateTime;
use DB;
use Auth;

class InfoEmployeeController extends Controller
{
    /**___________________________________________________________________
     * Employee List
     * ____________________________________________________________________
     */
    public function employee_list()
    {
        // $educational = InfoEducational::where('emp_id',3)->first();
        // $work_experience = InfoWorkExperience::where('emp_id',3)->first();
        // $bank = InfoBank::where('emp_id',3)->first();
        // $nominee = InfoNominee::where('emp_id',3)->first();

        // dd($work_experience->status);

        $user = User::where('status', 1)->get();
        return view('layouts.pages.admin.info_employee.employee_list',compact('user'));
    }
    public function employee_details($id)
    {
        $user = User::get();
        return view('layouts.pages.admin.info_employee.employee_details',compact('user'));
    }

    /**___________________________________________________________________
     * Employee Register Process
     * ____________________________________________________________________
     */
    public function employee_create()
    {

        $user = User::where( 'is_admin', '!=', 1)->orWhere('status', '!=', 1)->get();
        return view('layouts.pages.admin.info_employee.employee_register',compact('user'));
    }
    public function employee_register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:80',
            'email' => 'required|email|unique:users,email',
        ]);
        $employee_codes = Helper::IDGenerator(new User, 'employee_code', 5, 'GULF'); /* Generate id */

        $user= new User();
        $user->employee_code= $employee_codes;
        $user->name= $request->name;
        $user->email= $request->email;
        $user->contact_number=$request->contact_number;
        $user->password=bcrypt($request->password);
        $user->status='0';
        $user->is_admin='0';
        $user->email_verified_at='2023-01-01';
        $user->save();
        
        $notification=array('messege'=>'User created successfully!','alert-type'=>'success');
        return redirect()->route('info_employee_prsonal.create', $user->id)->with($notification);
    }
    public function employee_destroy($id)
    {
        // $data=User::find($id);
        // $data->delete();
        User::destroy($id);

        $notification=array('messege'=>'User delete successfully!','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
    /**___________________________________________________________________
     * Personal Information
     * ____________________________________________________________________
     */
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
        $emp_id = $id;
        $user_id = Auth::user()->id;
        $user=User::find($id);
        $department =MastDepartment::get();
        $designation =MastDesignation::get();
        $employee_category =MastEmployeeCategory::get();

        return view('layouts.pages.admin.info_employee.info_personal',compact('data','user','department','designation','employee_category'));
    }
    public function personal_store(Request $request, $id)
    {
        //----------User Update
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
            'status' => 1,
        ]);

        //----------Personal Info
        $data= new InfoPersonal();
        $data->emp_id= $id;
        $data->user_id = Auth::user()->id;
        
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
        
        $notification=array('messege'=>'Personal info save successfully!','alert-type'=>'success');
        return redirect()->route('info_employee_related.create', $id)->with($notification);
    }
    /**___________________________________________________________________
     * Related Information
     * ____________________________________________________________________
     */
    public function related_create($id)
    {
        $user =User::findorfail($id);
        $educational =InfoEducational::orderBy('id','DESC')->where('emp_id', $id)->get();
        $work_experience =InfoWorkExperience::orderBy('id','DESC')->where('emp_id', $id)->get();
        $info_bank =InfoBank::orderBy('id','DESC')->where('emp_id', $id)->get();
        $info_nominee =InfoNominee::orderBy('id','DESC')->where('emp_id', $id)->get();
        $user_id = $id;

        return view('layouts.pages.admin.info_employee.info_related',compact('user','educational','work_experience','info_bank','user_id','info_nominee'));
    }

    public function related_store(Request $request, $id) 
    {
        $educational = InfoEducational::where('emp_id', $id)->first();
        $work_experience = InfoWorkExperience::where('emp_id', $id)->first();
        $bank = InfoBank::where('emp_id', $id)->first();
        $nominee = InfoNominee::where('emp_id', $id)->first();

        if($request->institute_name != null){
            $validator = Validator::make($request->all(), [
                'qualification' => 'required',
                'institute_name' => 'required',
                'passing_year' => 'required',
                'grade' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            if($work_experience && $bank && $nominee){
                $user =User::findorfail($id);
                $user->is_admin = 1;
                $user->save();
            }
            $data= new InfoEducational();
            $data->qualification=$request->qualification;
            $data->institute_name=$request->institute_name;
            $data->passing_year=$request->passing_year;
            $data->grade=$request->grade;
            $data->emp_id= $id;
            $data->user_id = Auth::user()->id;
            $data->save();
            return response()->json($data);
        }elseif($request->company_name){
            $validator = Validator::make($request->all(), [
                'company_name' => 'required',
                'designation' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            if($educational && $bank && $nominee){
                $user =User::findorfail($id);
                $user->is_admin = 1;
                $user->save();
            }
            $data= new InfoWorkExperience();
            $data->company_name=$request->company_name;
            $data->designation=$request->designation;
            $data->start_date=$request->start_date;
            $data->end_date=$request->end_date;
            $data->job_description=$request->job_description;
            $data->emp_id= $id;
            $data->user_id = Auth::user()->id;
            $data->save();
            return response()->json($data);
        }elseif ($request->bank_name) {
            $validator = Validator::make($request->all(), [
                'bank_name' => 'required',
                'brance_name' => 'required',
                'acount_name' => 'required',
                'acount_no' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            if($work_experience && $educational && $nominee){
                $user =User::findorfail($id);
                $user->is_admin = 1;
                $user->save();
            }
            $data= new InfoBank();
            $data->bank_name=$request->bank_name;
            $data->brance_name=$request->brance_name;
            $data->acount_name=$request->acount_name;
            $data->acount_no=$request->acount_no;
            $data->acount_type=$request->acount_type;
            $data->emp_id= $id;
            $data->user_id = Auth::user()->id;
            $data->save();
            return response()->json($data);
        }elseif($request->full_name){
            $validator = Validator::make($request->all(), [
                'full_name' => 'required',
                'nid_no' => 'required',
                'relation' => 'required',
                'mobile_no' => 'required',
                'profile_image' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            if($work_experience && $bank && $educational){
                $user =User::findorfail($id);
                $user->is_admin = 1;
                $user->save();
            }
            if($request->hasFile("profile_image")){
                $file=$request->file("profile_image");
                $imageName=time()."_".$file->getClientOriginalName();
                $file->move(\public_path("images/profile/nominee"),$imageName);
                $request['profile_image']=$imageName;
            }
            $data= new InfoNominee();
            $data->full_name=$request->full_name;
            $data->nid_no=$request->nid_no;
            $data->relation=$request->relation;
            $data->mobile_no=$request->mobile_no;
            $data->nominee_percentage=$request->nominee_percentage;
            $data->profile_image=$imageName;
            $data->emp_id= $id;
            $data->user_id = Auth::user()->id;
            $data->save();
            return response()->json($data);
        }else{
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
        }
    }
    public function info_education_destroy($id)
    {
        // $data=InfoEducational::find($id);
        // $data->delete();
        InfoEducational::destroy($id);
        return response()->json('success');
    }
    public function info_experience_destroy($id)
    {
        $data=InfoWorkExperience::find($id);
        $data->delete();
        return response()->json('success');
    }
    public function info_bank_destroy($id)
    {
        $data=InfoBank::find($id);
        $data->delete();
        return response()->json('success');
    }
    public function info_nominee_destroy($id)
    {
        $data=InfoNominee::find($id);
        //-------Eloquent ORM
        if (File::exists("public/images/profile/nominee/".$data->profile_image)) {
            File::delete("public/images/profile/nominee/".$data->profile_image);
        }
        $data->delete();
        return response()->json('success');
    }
    /**___________________________________________________________________
     * 
     * ____________________________________________________________________
     */

}
