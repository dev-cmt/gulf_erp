<x-app-layout>
    <style>
        /*__________________Image Profile______________________*/
        .avatar-upload {
            position: relative;
            max-width: 205px;
            margin: 20px auto;
        }
        .avatar-upload .avatar-edit {
            position: absolute;
            right: 25px;
            z-index: 1;
            top: 10px;
        }
        .avatar-upload .avatar-edit input {
            display: none;
        }
        .avatar-upload .avatar-edit input + label {
            display: inline-block;
            width: 34px;
            height: 34px;
            margin-bottom: 0;
            border-radius: 100%;
            background: #f04e23;
            border: 1px solid transparent;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
            cursor: pointer;
            font-weight: normal;
            transition: all 0.2s ease-in-out;
        }
        .avatar-upload .avatar-edit input + label:hover {
            background: #f1f1f1;
            border-color: #d6d6d6;
        }
    
        .avatar-edit .profile_save_btn{
            color: #ffffff;
            position: absolute;
            top: 9px;
            left: 0;
            right: 0;
            text-align: center;
            margin: auto;
        }
        .avatar-upload .avatar-preview {
            width: 192px;
            height: 192px;
            position: relative;
            border-radius: 100%;
            border: 6px solid #f04e23;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
        }
        .avatar-upload .avatar-preview > div {
            width: 100%;
            height: 100%;
            border-radius: 100%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
    </style>
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Personal Information</h4>
                </div>

                <div class="card-body form-validation">
                    @if (session()->has('success'))
                        <strong class="text-success">{{session()->get('success')}}</strong>
                    @endif
                    <form class="form-valide" data-action="{{ route('info_personal.store') }}" method="POST" enctype="multipart/form-data" id="add-user-form">
                        @csrf
                        <div id="smartwizard" class="form-wizard order-create">
                            <ul class="nav nav-wizard">
                                <li><a class="nav-link" href="#wizard_Service">
                                    <span>1</span>
                                </a></li>
                                <li><a class="nav-link" href="#wizard_Time">
                                    <span>2</span>
                                </a></li>
                                <li><a class="nav-link" href="#wizard_Details">
                                    <span>3</span>
                                </a></li>
                                <li><a class="nav-link" href="#wizard_Payment">
                                    <span>4</span>
                                </a></li>
                                <li><a class="nav-link" href="#UploadFile">
                                    <span>5</span>
                                </a></li>
                            </ul>
                            
                            <div class="tab-content">
                                <div id="wizard_Service" class="tab-pane" role="tabpanel">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label" for="email">Email*</label>
                                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="" value="{{old('email')}}" required/>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">Mobile*</label>
                                                <input type="number" name="contact_number" class="form-control @error('contact_number') is-invalid @enderror" placeholder="" value="{{old('contact_number')}}" />
                                                @error('contact_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">First Name*</label>
                                                <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" placeholder="" value="{{old('first_name')}}" />
                                                @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">Last Name</label>
                                                <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder="" value="{{old('last_name')}}" />
                                                @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">Date of Birth*</label>
                                                <input type="date" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" placeholder="" value="{{old('date_of_birth')}}" />
                                                @error('date_of_birth')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">Gender</label>
                                                <select name="employee_gender" class="form-control default-select  @error('employee_gender') is-invalid @enderror" style="height: 40px;">
                                                    <option value="0">Male</option>
                                                    <option value="1">Female</option>
                                                </select>                                                
                                                @error('employee_gender')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">NID*</label>
                                                <input type="number" name="nid_no" class="form-control @error('nid_no') is-invalid @enderror" placeholder="xxxxxxxxxxxxx" value="{{old('nid_no')}}" />
                                                @error('nid_no')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">Blood Group*</label>
                                                <select name="blood_group" class="form-control default-select  @error('blood_group') is-invalid @enderror" style="height: 40px;">
                                                    <option value="0">O Positive (0+)</option>
                                                    <option value="1">O Negative (0-)</option>
                                                    <option value="2">A Positive (A+)</option>
                                                    <option value="3">A Negative (A-)</option>
                                                    <option value="4">B Positive (B+)</option>
                                                    <option value="5">B Negative (B-)</option>
                                                    <option value="6">AB Positive (AB+)</option>
                                                    <option value="7">AB Negative (AB-)</option>
                                                </select>
                                                @error('blood_group')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div id="wizard_Time" class="tab-pane" role="tabpanel">
                                    <p class="text-label text-primary" style="margin-top:-25px;font-style:bold">Official Information</p>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">Department</label>
                                                <select name="department" class="form-control default-select  @error('department') is-invalid @enderror" style="height: 40px;">
                                                    <option value="0">Sales</option>
                                                    <option value="1">Marketing</option>
                                                </select>                                                
                                                @error('department')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">Designation</label>
                                                <select name="designation" class="form-control default-select  @error('designation') is-invalid @enderror" style="height: 40px;">
                                                    <option value="0">Sales Manager</option>
                                                    <option value="1">Account Manager</option>
                                                </select> 
                                                @error('designation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">Employee Type</label>
                                                <select name="employee_type" class="form-control default-select  @error('employee_type') is-invalid @enderror" style="height: 40px;">
                                                    <option value="0">Srevice Man</option>
                                                    <option value="1">Sales Man</option>
                                                </select> 
                                                @error('employee_type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">Work Station*</label>
                                                <select name="work_station" class="form-control default-select  @error('work_station') is-invalid @enderror" style="height: 40px;">
                                                    <option value="0">Srevice Man</option>
                                                    <option value="1">Sales Man</option>
                                                </select>
                                                @error('work_station')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">Mobile (Official)</label>
                                                <input type="number" name="number_official" class="form-control @error('name') is-invalid @enderror" placeholder="" value="{{old('number_official')}}" />
                                                @error('number_official')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">Email (Official)</label>
                                                <input type="email" name="email_official" class="form-control @error('email_official') is-invalid @enderror" placeholder="" value="{{old('email_official')}}" />
                                                @error('email_official')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">Joining Data*</label>
                                                <input type="date" name="joining_date" class="form-control @error('joining_date') is-invalid @enderror" placeholder="" value="{{old('joining_date')}}" />
                                                @error('joining_date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">Service Length</label>
                                                <input type="number" name="service_length" class="form-control @error('service_length') is-invalid @enderror" placeholder="" value="{{old('service_length')}}" />
                                                @error('service_length')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">Gross Salary</label>
                                                <input type="number" name="gross_salary" class="form-control @error('gross_salary') is-invalid @enderror" placeholder="" value="{{old('gross_salary')}}" />
                                                @error('gross_salary')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">Reporting Boss</label>
                                                <select name="reporting_boss" class="form-control default-select  @error('reporting_boss') is-invalid @enderror" style="height: 40px;">
                                                    <option value="0">Sabit</option>
                                                    <option value="1">Alam</option>
                                                </select>
                                                @error('reporting_boss')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div id="wizard_Details" class="tab-pane" role="tabpanel">
                                    <p class="text-label text-primary" style="margin-top:-25px;font-style:bold">Present Information</p>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">District*</label>
                                                <input type="test" name="district_present" class="form-control @error('district_present') is-invalid @enderror" placeholder="" value="{{old('district_present')}}" />
                                                @error('district_present')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">City*</label>
                                                <input type="test" name="city_present" class="form-control @error('city_present') is-invalid @enderror" placeholder="" value="{{old('city_present')}}" />
                                                @error('city_present')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">Thana*</label>
                                                <input type="test" name="thana_present" class="form-control @error('thana_present') is-invalid @enderror" placeholder="" value="{{old('thana_present')}}" />
                                                @error('thana_present')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">Ziip Code</label>
                                                <input type="test" name="zip_code_present" class="form-control @error('zip_code_present') is-invalid @enderror" placeholder="" value="{{old('zip_code_present')}}" />
                                                @error('zip_code_present')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">Address Description</label>
                                                <textarea name="address_present" class="form-control @error('address_present') is-invalid @enderror" rows="2" placeholder="Address Details">{{old('address_present')}}</textarea>
                                                @error('address_present')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mt-5">
                                                <div class="custom-control custom-checkbox checkbox-success">
                                                    <input type="checkbox" class="custom-control-input" id="samePermanent">
                                                    <label class="custom-control-label p-1" for="customCheckBox6">Same as permanent address?</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <hr><p class="text-label bg-white text-primary" style="margin-top:-30px;font-style:bold;width:130px">Permanent Address</p>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">District*</label>
                                                <input type="test" name="district_permanent" class="form-control @error('district_permanent') is-invalid @enderror" placeholder="" value="{{old('district_permanent')}}" />
                                                @error('district_permanent')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">City*</label>
                                                <input type="test" name="city_permanent" class="form-control @error('city_permanent') is-invalid @enderror" placeholder="" value="{{old('city_permanent')}}" />
                                                @error('city_permanent')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">Thana*</label>
                                                <input type="test" name="thana_permanent" class="form-control @error('thana_permanent') is-invalid @enderror" placeholder="" value="{{old('thana_permanent')}}" />
                                                @error('thana_permanent')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">Ziip Code</label>
                                                <input type="test" name="zip_code_permanent" class="form-control @error('zip_code_permanent') is-invalid @enderror" placeholder="" value="{{old('zip_code_permanent')}}" />
                                                @error('zip_code_permanent')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="text-label">Address Description</label>
                                                <textarea name="address_permanent" class="form-control @error('address_permanent') is-invalid @enderror" rows="2" placeholder="Type your address"></textarea>
                                                @error('address_permanent')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div id="wizard_Payment" class="tab-pane" role="tabpanel">
                                    <p class="text-label text-primary" style="margin-top:-25px;font-style:bold">Other Information</p>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">Passport No.*</label>
                                                <input type="number" name="passport_no" class="form-control @error('passport_no') is-invalid @enderror" placeholder="" value="{{old('passport_no')}}" />
                                                @error('passport_no')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">Driving License No.*</label>
                                                <input type="number" name="driving_license" class="form-control @error('driving_license') is-invalid @enderror" placeholder="" value="{{old('driving_license')}}" />
                                                @error('driving_license')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">Marital Status*</label>
                                                <select name="marital_status" class="form-control default-select  @error('marital_status') is-invalid @enderror" style="height: 40px;">
                                                    <option value="0" selected>Unmarried</option>
                                                    <option value="1" {{ old('marital_status') == '1' ? 'selected' : '' }}>Married</option>
                                                    <option value="2" {{ old('marital_status') == '2' ? 'selected' : '' }}>Divorce</option>
                                                    <option value="3" {{ old('marital_status') == '3' ? 'selected' : '' }}>Widowed</option>
                                                </select>
                                                @error('marital_status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">Home Phone</label>
                                                <input type="test" name="house_phone" class="form-control @error('house_phone') is-invalid @enderror" placeholder="" value="{{old('house_phone')}}" />
                                                @error('house_phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">Father Name*</label>
                                                <input type="test" name="father_name" class="form-control @error('father_name') is-invalid @enderror" placeholder="" value="{{old('father_name')}}" />
                                                @error('father_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">Mother Name*</label>
                                                <input type="test" name="mother_name" class="form-control @error('mother_name') is-invalid @enderror" placeholder="" value="{{old('mother_name')}}" />
                                                @error('mother_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">Birth Certificate No.*</label>
                                                <input type="test" name="birth_certificate_no" class="form-control @error('birth_certificate_no') is-invalid @enderror" placeholder="" value="{{old('birth_certificate_no')}}" />
                                                @error('birth_certificate_no')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <hr><p class="text-label bg-white text-primary" style="margin-top:-30px;font-style:bold;width:130px">Emergency Contact</p>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">Person Name*</label>
                                                <input type="test" name="emg_person_name" class="form-control @error('emg_person_name') is-invalid @enderror" placeholder="" value="{{old('emg_person_name')}}" />
                                                @error('emg_person_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">Phone Number*</label>
                                                <input type="test" name="emg_phone_number" class="form-control @error('emg_phone_number') is-invalid @enderror" placeholder="" value="{{old('emg_phone_number')}}" />
                                                @error('emg_phone_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">Relationship*</label>
                                                <input type="test" name="emg_relationship" class="form-control @error('emg_relationship') is-invalid @enderror" placeholder="" value="{{old('emg_relationship')}}" />
                                                @error('emg_relationship')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">Address</label>
                                                <input type="test" name="emg_address" class="form-control @error('emg_address') is-invalid @enderror" placeholder="" value="{{old('emg_address')}}" />
                                                @error('emg_address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div id="UploadFile" class="tab-pane" role="tabpanel">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="skip-email text-center">
                                                <div class="avatar-upload">
                                                    <div class="avatar-edit">
                                                        <input type='file' class="@error('profile_photo_path') is-invalid @enderror form-control" name="profile_photo_path" id="imageUpload" accept=".png, .jpg, .jpeg" value="{{old('profile_photo_path')}}"/>
                                                        <label><i class="fa fa-camera profile_save_btn"></i></label>
                                                        @error('profile_photo_path')
                                                            <span class="invalid-feedback" role="alert" style="position: absolute;top: 178px;left: -160px;width: 300px;">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <label for="imageUpload" class="avatar-preview">
                                                        <div id="imagePreview" style="background-image: url('{{asset('public')}}/images/profile/fix/blank_man.png');"></div>
                                                    </label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="skip-email form-group text-center">
                                                <button type="submit" class="btn btn-success">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>

    {{-- <div redirect-action="{{ route('info_related.create') }}" id="redirect"></div> --}}
    <script>
        $(document).ready(function(){
            var form = '#add-user-form';

            $(form).on('submit', function(event){
                event.preventDefault();

                var url = $(this).attr('data-action');
                var redirect = $('#redirect').attr('redirect-action');

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: new FormData(this),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(response)
                    {
                        $(form).trigger("reset");
                        alert(response.success);
                        // window.location.href = redirect;
                    },
                    error: function(response) {
                    }
                });
            });

        });
    </script>

    
    <!--Image Profile-->
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function() {
            readURL(this);
        });
    </script>
</x-app-layout>