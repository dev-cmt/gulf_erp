<x-app-layout>

    <div class="row">

        <div class="col-12">

            <div class="card">

                <!-- card header -->
                <div class="card-header">
                    <h4 class="card-title">Manual Attendance</h4>
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
                        <form class="form-valide" action="{{ route('manualattendances.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">

                                <div class="col-xl-6">

                                    <!-- this is for employee name -->
                                    <div class="form-group col">

                                        <label class="row-lg col-form-label">Employee Name
                                            <span class="text-danger">*</span>
                                        </label>

                                        <div class="row-lg">
                                        <select class="dropdwon_select" name="user_name">
                                                <option selected disabled>Please select</option>
                                                @foreach ($user as $row)
                                                <option value="{{$row->id}}">{{$row->name}}<option>
                                                @endforeach
                                            </select>
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>    
                                            @enderror
                                        </div>

                                    </div>
                                    
                                    <!-- this is for description -->
                                    <div class="form-group col">

                                        <label class="row-lg col-form-label">Date
                                            <span class="text-danger">*</span>
                                        </label>

                                        <div class="row-lg">
                                            <input type="date" id="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{old('date')}}">

                                            @error('date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                    </div>

                                </div>



                                <div class="col-xl-6">

                                    <!-- this is for department head -->
                                    <div class="form-group col">

                                        <label class="row-lg col-form-label">Employee Code
                                            <span class="text-danger">*</span>
                                        </label>

                                        <div class="row-lg">
                                            <input type="text" id="emp_code" class="form-control @error('emp_code') is-invalid @enderror" name="employee_code" placeholder="Enter Employee Code" value="{{old('emp_code')}}"> 

                                            @error('emp_code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                    </div>
                                    

                                    <!-- this is for status -->
                                    <div class="form-group col">

                                        <label class="row-lg col-form-label" for="att_type">Attendance Type
                                            <span class="text-danger">*</span>
                                        </label>

                                        <div class="row-lg">
                                            <select class="form-control" id="att_type" name="attendance_type" value="{{old('att_type')}}">

                                                <option value="1">Manual</option>
                                                <option value="2">Biomatric</option>
                                                <option value="3">Software</option>
                                                <option value="4">Card Punch</option>
                                                
                                            </select>
                                        </div>

                                    </div>

                                </div>



                                <div class="col-xl-6">

                                    <!-- this is for start time -->
                                    <div class="form-group col">

                                        <label class="row-lg col-form-label">Start Time
                                            <span class="text-danger">*</span>
                                        </label>

                                        <div class="row-lg">
                                            <input type="time" id="st_time" class="form-control @error('st_time') is-invalid @enderror" name="start_time" placeholder="Enter Employee Name" value="{{old('st_time')}}"> 

                                            @error('st_time')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                    </div>
                                    
                                    <!-- this is for end time -->
                                    <div class="form-group col">

                                         <label class="row-lg col-form-label">Location
                                            <span class="text-danger">*</span>
                                        </label>

                                        <div class="row-lg">
                                            <input type="text" id="loc" class="form-control @error('loc') is-invalid @enderror" name="location" placeholder="Enter Location" value="{{old('loc')}}">                                     
                                            @error('loc')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        

                                    </div>

                                </div>




                                <div class="col-xl-6">

                                    <!-- this is for location -->
                                    <div class="form-group col">

                                        <label class="row-lg col-form-label">End Time
                                            <span class="text-danger">*</span>
                                        </label>

                                        <div class="row-lg">
                                            <input type="time" id="en_time" class="form-control @error('en_time') is-invalid @enderror" name="end_time" value="{{old('en_time')}}">

                                            @error('en_time')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                    </div>
                                    
                                    <!-- this is for end time -->
                                    <div class="form-group col">

                                    <label class="row-lg col-form-label">Status
                                            <span class="text-danger">*</span>
                                        </label>

                                        <div class="row-lg">
                                           <select name="status" id="" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="0">In Active</option>
                                            </select>                                
                                            @error('stat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                    </div>

                                </div>


                                <div class="col-lg-12">

                                    <!-- this is for remarks -->
                                    <div class="form-group col">

                                        <label>Remarks:</label>

                                        <div class="row-lg">
                                            <textarea class="form-control mt-1 @error('rem') is-invalid @enderror" rows="2" id="rem" name="message" placeholder="Please Write Something..." value="{{old('rem')}}"></textarea>

                                            @error('rem')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>

                                    </div>

                                <!-- submit button -->
                                <div class="col-lg">
                                    <button type="submit" class="btn btn-success btn-sm float-right mr-3">Submit</button>
                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>

<script>
    $(function () {
        $(".dropdwon_select").select2();
    }); 
</script>