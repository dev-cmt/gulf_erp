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

    <style>
            :root {
                --primary-color: #f04e23;
            }
            /* Progressbar */
            .progressbar {
                position: relative;
                display: flex;
                justify-content: space-between;
                counter-reset: step;
                margin: 0px 20px 80px 20px;
            }

            .progressbar::before,
            .progress {
                content: "";
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                height: 4px;
                width: 100%;
                background-color: #dcdcdc;
                z-index: -1;
            }

            .progress {
                background-color: var(--primary-color);
                width: 0%;
                transition: 0.3s;
            }

            .progress-step {
                width: 2.1875rem;
                height: 2.1875rem;
                background-color: #dcdcdc;
                border-radius: 50%;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .progress-step::before {
                counter-increment: step;
                content: counter(step);
            }

            .progress-step::after {
                content: attr(data-title);
                position: absolute;
                top: calc(100% + 0.5rem);
                font-size: 0.85rem;
                color: #666;
            }

            .progress-step-active {
                background-color: var(--primary-color);
                color: #f3f3f3;
            }

            /* Form */
            .form {
                width: clamp(320px, 30%, 430px);
                margin: 0 auto;
                border: 1px solid #ccc;
                border-radius: 0.35rem;
                padding: 1.5rem;
            }

            .form-step {
                display: none;
                transform-origin: top;
                animation: animate 0.5s;
            }

            .form-step-active {
            display: block;
            }

            .input-group {
                margin: 2rem 0;
            }

            @keyframes animate {
                from {
                    transform: scale(1, 0);
                    opacity: 0;
                }
                to {
                    transform: scale(1, 1);
                    opacity: 1;
                }
            }
    </style>

    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Personal Information</h4>
                </div>

                <div class="card-body">
                    @if (session()->has('success'))
                        <strong class="text-success">{{session()->get('success')}}</strong>
                    @endif
                    <form class="form-valide" action="{{ route('info_personal.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <!-- Progress bar -->
                                <div class="progressbar">
                                    <div class="progress" id="progress"></div>
                                    <div class="progress-step progress-step-active" data-title="Introduction"></div>
                                    <div class="progress-step" data-title="Official Information"></div>
                                    <div class="progress-step" data-title="Present Information"></div>
                                    <div class="progress-step" data-title="Other Information"></div>
                                    <div class="progress-step" data-title="Document"></div>
                                </div>
                            </div>
                        </div>
                    
                        <!-- Steps -->
                        <div class="form-step form-step-active">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-label" for="email">Email*</label>
                                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="" value="{{old('email')}}"/>
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
                            <div class="row">
                                <div class="col-12 text-right">
                                    <button type="button" class="btn btn-next btn btn-primary btn-sm">Next</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-step">
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
                                        <label class="text-label">Work Station</label>
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
                            <div class="row">
                                <div class="col-12 text-right">
                                    <button type="button" class="btn btn-prev btn btn-primary btn-sm">Previous</button>
                                    <button type="button" class="btn btn-next btn btn-primary btn-sm">Next</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-step">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-label">Division*</label>
                                        <select name="division_present" class="form-control dropdwon_select @error('division_present') is-invalid @enderror" id="division" value="{{old('division_present')}}">
                                            <option selected disabled>Select Division</option>
                                            @foreach($data['divisions'] as $division)
                                                <option value="{{ $division->id }}">{{ $division->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('division_present')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-label">District*</label>
                                        <select name="district_present" class="form-control dropdwon_select @error('district_present') is-invalid @enderror" id="district" value="{{old('district_present')}}"></select>
                                        @error('district_present')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-label">Upazila*</label>
                                        <select name="upazila_present" class="form-control dropdwon_select @error('upazila_present') is-invalid @enderror" id="upazila" value="{{old('upazila_present')}}"></select>
                                        @error('upazila_present')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-label">Thana*</label>
                                        <select name="thana_present" class="form-control dropdwon_select @error('thana_present') is-invalid @enderror" id="thana" value="{{old('thana_present')}}"></select>
                                        @error('thana_present')
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
                                            <input type="checkbox" class="custom-control-input" id="same-address-checkbox">
                                            <label class="custom-control-label p-1" for="same-address-checkbox">Same as permanent address?</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <hr><p class="text-label bg-white text-primary" style="margin-top:-30px;font-style:bold;width:130px">Permanent Address</p>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-label">Division</label>
                                        <select name="division_permanent" class="form-control dropdwon_select @error('division_permanent') is-invalid @enderror" id="permanent-division" value="{{old('division_permanent')}}">
                                            <option selected disabled>Select Division</option>
                                            @foreach($data['divisions'] as $division)
                                                <option value="{{ $division->id }}">{{ $division->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('division_permanent')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-label">District</label>
                                        <select name="district_permanent" class="form-control dropdwon_select @error('district_permanent') is-invalid @enderror" id="permanent-district" value="{{old('district_permanent')}}"></select>
                                        @error('district_permanent')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-label">Upazila</label>
                                        <select name="upazila_permanent" class="form-control dropdwon_select @error('upazila_permanent') is-invalid @enderror" id="permanent-upazila" value="{{old('upazila_permanent')}}"></select>
                                        @error('upazila_permanent')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-label">Thana</label>
                                        <select name="thana_permanent" class="form-control @error('thana_permanent') is-invalid @enderror" id="permanent-thana" value="{{old('thana_permanent')}}"></select>
                                        @error('thana_permanent')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-label">Address Description</label>
                                        <textarea name="address_permanent" class="form-control  @error('address_permanent') is-invalid @enderror" rows="2" placeholder="Type your address"></textarea>
                                        @error('address_permanent')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-right">
                                    <button type="button" class="btn btn-prev btn btn-primary btn-sm">Previous</button>
                                    <button type="button" class="btn btn-next btn btn-primary btn-sm">Next</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-step">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-label">Passport No.</label>
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
                                        <label class="text-label">Driving License No.</label>
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
                                        <label class="text-label">Marital Status</label>
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
                                        <label class="text-label">Birth Certificate No.</label>
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
                            <div class="row">
                                <div class="col-12 text-right">
                                    <button type="button" class="btn btn-prev btn btn-primary btn-sm">Previous</button>
                                    <button type="button" class="btn btn-next btn btn-primary btn-sm">Next</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-step">
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
                                <div class="col-12 text-right">
                                    <button type="button" class="btn btn-prev btn btn-primary btn-sm">Previous</button>
                                    <input type="submit" class="btn btn-success btn-sm" value="Submit"/>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    
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

    <!--Form Step-->
    <script>
        const prevBtns = document.querySelectorAll(".btn-prev");
        const nextBtns = document.querySelectorAll(".btn-next");
        const progress = document.getElementById("progress");
        const formSteps = document.querySelectorAll(".form-step");
        const progressSteps = document.querySelectorAll(".progress-step");

        let formStepsNum = 0;

        nextBtns.forEach((btn) => {
        btn.addEventListener("click", () => {
                formStepsNum++;
                updateFormSteps();
                updateProgressbar();
            });
        });

        prevBtns.forEach((btn) => {
        btn.addEventListener("click", () => {
                formStepsNum--;
                updateFormSteps();
                updateProgressbar();
            });
        });

        function updateFormSteps() {
            formSteps.forEach((formStep) => {
                formStep.classList.contains("form-step-active") &&
                formStep.classList.remove("form-step-active");
            });

            formSteps[formStepsNum].classList.add("form-step-active");
        }

        function updateProgressbar() {
            progressSteps.forEach((progressStep, idx) => {
                if (idx < formStepsNum + 1) {
                    progressStep.classList.add("progress-step-active");
                } else {
                    progressStep.classList.remove("progress-step-active");
                }
            });

            const progressActive = document.querySelectorAll(".progress-step-active");
            progress.style.width = ((progressActive.length - 1) / (progressSteps.length - 1)) * 100 + "%";
        }
    </script>

    <!-- Divistion -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#division').change(function(){
                var division_id = $(this).val();
                var option = '';
    
                $.ajax({
                    url : "{{ url('/get-districts') }}",
                    method : "GET",
                    data : {'division_id' : division_id},
                    dataType : 'json',
    
                    success:function(response){
                        var district_length = response.length; 
                        option += "<option selected disabled>Select District</option>";
                        for( var i = 0; i < district_length; i++){
                            var id = response[i]['id'];
                            var district_name = response[i]['name'];
                            option += "<option value='"+id+"'>"+district_name+"</option>";
                            $('#district').empty();
                        }
                        $("#district").append(option);
                        $("#permanent-district").append(option);
                    },
                    error:function(){
                        console.log("There was an error while fetching District!");
                    }
                });
            });
    
            $('#district').change(function(){
                var district_id = $(this).val();
                var upazila_option = '';
    
                $.ajax({
                    url : "{{ url('/get-upazila') }}",
                    method : "GET",
                    data : {'district_id' : district_id},
                    dataType : 'json',
    
                    success:function(upazilas){
                        upazila_option += "<option selected disabled>Select Upazila</option>";
                        for(var i = 0; i < upazilas.length; i++){
                            var upazila_id = upazilas[i]['id'];
                            var upazila_name = upazilas[i]['name'];
                            upazila_option += "<option value='"+upazila_id+"'>"+upazila_name+"</option>";
                            $('#upazila').empty();
                        }
                        $('#upazila').append(upazila_option);
                        $('#permanent-upazila').append(upazila_option);
                    },
                    error:function(){
                        console.log("There was an error while fetching Upazila!");
                    }
    
                });
            });
    
            $('#upazila').change(function(){
                var upazilas_id = $(this).val();
                var thana_option = '';
    
                $.ajax({
                    url : "{{ url('/get-thana') }}",
                    method : "GET",
                    data : {'upazilas_id' : upazilas_id},
                    dataType : 'json',
    
                    success:function(thana){
                        thana_option += "<option selected disabled>Select Thana</option>";
                        for(var i = 0; i < thana.length; i++){
                            var thana_id = thana[i]['id'];
                            var thana_name = thana[i]['bn_name'];
                            thana_option += "<option value='"+thana_id+"'>"+thana_name+"</option>";
                            $('#thana').empty();
                        }
                        $('#thana').append(thana_option);
                        $('#permanent-thana').append(thana_option);
                    },
                    error:function(){
                        console.log("There was an error while fetching Thana!");
                    }
    
                });
            });
        });
    
        // ------Same As Permanent Address
        const presentAddressDropdown = document.getElementById("division");
        const permanentAddressDropdown = document.getElementById("permanent-division");
    
        const presentDistrictDropdown = document.getElementById("district");
        const permanentDistrictDropdown = document.getElementById("permanent-district");
    
        const presentUpazilaDropdown = document.getElementById("upazila");
        const permanentUpazilaDropdown = document.getElementById("permanent-upazila");
    
        const presentThanaDropdown = document.getElementById("thana");
        const permanentThanaDropdown = document.getElementById("permanent-thana");
    
        const sameAddressCheckbox = document.getElementById("same-address-checkbox");
        sameAddressCheckbox.addEventListener("change", function() {
            if (sameAddressCheckbox.checked) {
                alert("Are you sure? Permanent address is the same as present address!");
                permanentAddressDropdown.value = presentAddressDropdown.value;
                permanentDistrictDropdown.value = presentDistrictDropdown.value;
                permanentUpazilaDropdown.value = presentUpazilaDropdown.value;
                permanentThanaDropdown.value = presentThanaDropdown.value;
            } else {
                permanentAddressDropdown.value = "";
                permanentDistrictDropdown.value = "";
                permanentUpazilaDropdown.value = "";
                permanentThanaDropdown.value = "";
            }
        });
    </script>
</x-app-layout>