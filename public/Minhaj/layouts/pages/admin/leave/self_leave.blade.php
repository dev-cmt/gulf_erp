<x-app-layout>

    <div class="row">

        <div class="col-12">

            <div class="card">

                <!-- card header -->
                <div class="card-header">
                    <h4 class="card-title">Emergency Leave</h4>
                    <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                </div>

                <!-- card body -->
                <div class="card-body">

                    <div class="form-validation">

                        <!-- this is for validation checking message -->
                        @if (session()->has('success'))
                            <strong class="text-success">{{session()->get('success')}}</strong>
                        @endif

                        <!-- this is from -->
                        

                        <form class="form-valide" action="{{route('leave.store')}}" method="post"      enctype="multipart/form-data" name="form">
                            @csrf
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group row">
                                        <label class="col-lg-6 col-form-label">Employee Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" readonly placeholder="Enter Name.." value="{{ Auth::user()->name }}">
                                
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-6 col-form-label">Start Date
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" placeholder="Enter Date.." value="{{old('date')}}" id="date">
                                            @error('start_date')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-6 col-form-label">Leave Type
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select name="leave_type" class="form-control default-select  @error('leave_type') is-invalid @enderror" style="height: 40px;">
                                                <option value="1">Sick Leave</option>
                                                <option value="2">Rest Leave</option>
                                                <option value="3">Festival Leave</option>
                                                <option value="4">Check Leave</option>
                                            </select>
                                            @error('leave_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-6 col-form-label">Leave Location</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control @error('leave_location') is-invalid @enderror" name="leave_location" placeholder="Enter location.." value="{{old('location')}}">
                                            @error('leave_location')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group row">
                                        <label class="col-lg-6 col-form-label">Designation</label>
                                        <div class="col-lg-6">
                                            <select name="designation" class="form-control default-select  @error('designation') is-invalid @enderror" style="height: 40px;">
                                                <option value="1">CEO</option>
                                                <option value="2">GM</option>
                                                <option value="3">AGM</option>
                                                <option value="4">HR</option>
                                            </select>
                                            @error('designation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-6 col-form-label">End Date
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="date" id="dateTwo" class="form-control @error('end_date') is-invalid @enderror" name="end_date" placeholder="Enter Date.." value="{{old('date')}}">
                                            @error('end_date')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-6 col-form-label">Leave Contact</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control @error('leave_contact') is-invalid @enderror" name="leave_contact" placeholder="Enter Contact.." value="{{old('contact')}}">
                                            @error('leave_contact')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-6 col-form-label">Purpose</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control @error('purpose') is-invalid @enderror" name="purpose" placeholder="Enter purpose.." value="{{old('purpose')}}">
                                            @error('purpose')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div style="height:20px">
                                <button type="button" class="btn btn-sm btn-danger light mt-4" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-sm btn-primary mt-4" id="output">Save</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
