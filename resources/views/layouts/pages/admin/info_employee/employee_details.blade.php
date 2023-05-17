<x-app-layout>
    <div class="row">
        <div class="col-md-12 col-sm-10 mx-auto">
            <!-- Profile widget -->
            <div class="bg-white shadow rounded overflow-hidden">
                <div class="p-4 bg-dark">
                    <div class="media align-items-end profile-header">
                        <div class="profile mr-4">
                            <div class="rounded mb-2 img-thumbnail" style="width:150px;height:150px;overflow:hidden">
                                <img src="{{asset('public/images')}}/profile/{{ $user->profile_photo_path }}" alt="..." style="height: 100%;width: 100%;object-fit: cover;">
                            </div>
                            <a href="#" class="btn btn-primary light text-white btn-sl-sm btn-block">Edit profile</a>
                        </div>
                        <div class="media-body mb-5 text-white">
                            <h4 class="text-white">{{$user->name}}</h4>
                            <p class="small mb-5"><i class="fa fa-calendar-o mr-2"></i>{{date("j F Y", strtotime($infoPersonal->joining_date))}}</p>
                        </div>
                    </div>
                </div>
    
                <div class="card-body">
                    <div class="profile-tab">
                        <div class="custom-tab-1">
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a href="#my-posts" data-toggle="tab" class="nav-link active">Employee Information</a></li>
                                <li class="nav-item"><a href="#about-me" data-toggle="tab" class="nav-link">Related Information</a></li>
                                <li class="nav-item"><a href="#profile-settings" data-toggle="tab" class="nav-link">Setting</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="my-posts" class="tab-pane fade active show">
                                    <!--=====// Personal Information//=====-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="text-primary my-3">Personal Information</h6>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Employee Name <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{$user->name }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Employee Code <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $user->employee_code }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Contact Number <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $user->contact_number }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Email Address <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $user->email }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Date Of Birth <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{date("j F Y", strtotime($infoPersonal->date_of_birth))}}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Gender<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7">
                                                    @if ($infoPersonal->employee_gender == 0)
                                                    <span>Male</span>
                                                    @else
                                                    <span>Female</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">NID No. <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->nid_no }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Blood Group <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7">
                                                    @if ($infoPersonal->blood_group ==1)
                                                    <span>O Positive (0+)</span>
                                                    @elseif ($infoPersonal->blood_group ==2)
                                                    <span>O Negative (0-)</span>
                                                    @elseif ($infoPersonal->blood_group ==3)
                                                    <span>A Positive (A+)</span>
                                                    @elseif ($infoPersonal->blood_group ==4)
                                                    <span>A Negative (A-)</span>
                                                    @elseif ($infoPersonal->blood_group ==5)
                                                    <span>B Positive (B+)</span>
                                                    @elseif ($infoPersonal->blood_group ==6)
                                                    <span>B Negative (B-)</span>
                                                    @elseif ($infoPersonal->blood_group ==7)
                                                    <span>AB Positive (AB+)</span>
                                                    @elseif ($infoPersonal->blood_group ==8)
                                                    <span>AB Negative (AB-)</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--=====// Official Information//=====-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="text-primary my-3">Official Information</h6>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Department<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{$department->dept_name}}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Designation<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $designation->desig_name}}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Employee Type<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->employee_type }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Work Station<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->work_station }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Mobile (Official)<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->number_official }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Email (Official)<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->email_official }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Joining Data<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{date("j F Y", strtotime($infoPersonal->joining_date))}}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Service Length<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->service_length }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Gross Salary <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->gross_salary }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Reporting Boss<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->reporting_boss }}</span></div>
                                            </div>
                                        </div>


                                    </div>
                                    <!--=====// Address//=====-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="text-primary my-3">Address Details</h6>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Present Address<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->zip_code_present }}, {{ $infoPersonal->thana_present }}, {{ $infoPersonal->city_present }}, {{ $infoPersonal->district_present }}</span></div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Address Details<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->address_present }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Permanent Address<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->zip_code_permanent }}, {{ $infoPersonal->thana_permanent }}, {{ $infoPersonal->city_permanent }}, {{ $infoPersonal->district_permanent }}</span></div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Address Details<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->address_permanent }}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--=====// Other Information //=====-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="text-primary my-3">Other Information</h6>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Father Name<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->father_name }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Mother Name<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->mother_name }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Passport No.<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->passport_no }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Driving License No.<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->driving_license }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Marital Status<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->marital_status }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Home Phone<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->house_phone }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Birth Certificate No.<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->birth_certificate_no }}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--=====// Emergency Contact //=====-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="text-primary my-3">Emergency Contact</h6>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Person Name<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->emg_person_name }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Phone Number<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->emg_phone_number }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Relationship<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->emg_relationship }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Address<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->emg_address }}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="about-me" class="tab-pane fade">
                                    <!--=====// Education Information //=====-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="text-primary my-3">Education Information</h6>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Person Name<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->profile_photo_path }}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--=====// Work Experi Information //=====-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="text-primary my-3">Related Information</h6>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Person Name<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->profile_photo_path }}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="profile-settings" class="tab-pane fade">
                                    
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="replyModal">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title">Post Reply</h6>
                                        <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <textarea class="form-control" rows="4">Message</textarea>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Reply</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End profile widget -->
    
        </div>
    </div>
</x-app-layout>
