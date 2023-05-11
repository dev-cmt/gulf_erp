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
                        <form class="form-valide mt-0" action="{{ route('manualattendances.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <form action="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row mt-2">
                                        <label for="" class="col-md-4">Employee Name 
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-8">
                                            <select class="dropdwon_select" name="emp_id" id="employeeName" value="" >
                                                <option value="" selected>Please select</option>
                                                @foreach ($data as $row)
                                                    <option value="{{ $row->id }}">{{ $row->name }} ({{ $row->employee_id }})</option>
                                                @endforeach
                                            </select>
                                            @error('emp_id')
                                            <span class="text-danger">{{ $errors->first('emp_id') }}</span>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <label class=" col-md-4">Date
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-8">
                                            <input type="date" id="date" class="form-control" name="date" value="{{old('date')}}">

                                            @error('date')
                                            <span class="text-danger">{{ $errors->first('date') }}</span>
                                        @enderror
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                       <label for="" class="col-md-4">In Time (hh:mm)
                                        <span class="text-danger">*</span>

                                       </label>
                                       <div class="col-md-8">
                                        <input type="time" id="st_time" class="form-control" name="start_time" placeholder="Enter Employee Name" value="09:00"> 

                                        @error('start_time')
                                                <span class="text-danger">{{ $errors->first('start_time') }}</span>
                                            @enderror
                                       </div>
                                    </div>

                                    <div class="row mt-2">
                                        <label for="" class="col-md-4">Location
                                            <span class="text-danger"></span>
                                        </label>
                                        <div class="col-md-8">
                                            <input type="text" id="location" class="form-control" name="location" placeholder="Enter Location" value="{{old('loc')}}">                                     
                                            @error('location')
                                                <span class="text-danger">{{ $errors->first('location') }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row mt-2">
                                        <label for="" class="col-md-4">Employee Code
                                            <span class="text-danger"></span>
                                        </label>
                                        <div class="col-md-8">
                                            <input type="text" readonly id="employeeCode" class="form-control @error('emp_code') is-invalid @enderror" name="employee_code" placeholder="Enter Employee Code" value="{{old('emp_code')}}"> 

                                            @error('emp_code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <label for="" class="col-md-4">Attendance Type
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="att_type" name="attendance_type" value="{{old('att_type')}}">

                                                <option value="1">Present</option>
                                                <option value="2">absent</option>
                                                
                                            </select>
                                            @error('attendance_type')
                                            <span class="text-danger">{{ $errors->first('attendance_type') }}</span>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <label for="" class="col-md-4">Out Time (hh : mm )
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-8">
                                            <input type="time" id="en_time" class="form-control" name="end_time" value="05:00">

                                            @error('end_time')
                                                <span class="text-danger">{{ $errors->first('end_time') }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- <div class="row mt-2">
                                        <label for="" class="col-md-4">Status
                                            <span class="text-danger"></span>
                                        </label>
                                        <div class="col-md-8">
                                            <select name="status" id="" class="form-control">
                                                <option selected disabled>select a status</option>
                                                <option value="1">Active</option>
                                                <option value="0">In Active</option>
                                                </select>                                
                                                @error('status')
                                                <span class="text-danger">{{ $errors->first('status') }}</span>
                                            @enderror
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="col-md-12">
                                    <div class="row mt-3">
                                        <label for="" class="col-md-2">Remarks:</label>
                                        <div class="col-md-10">
                                            <textarea  id="" cols="30" rows="1" class="form-control" name="message" placeholder="Please Write Something..."></textarea>
                                            @error('message')
                                                <span class="text-danger">{{ $errors->first('message') }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-12">
                                    <div class="row mt-2">
                                        <label for="" class="col-md-8"></label>
                                        {{-- <div class="col-md-4">
                                            <a href="" class="btn btn-success float-end" style="margin-left: 250px">submit</a>
                                        </div> --}}
                                        <button type="submit" class="btn btn-success btn-sm" style="margin-left: 270px">Submit</button>
                                        
                                    </div>
                                </div>
                            </div>
                            </form>

                            {{-- <div class="row">
                                <div class="col-md-6">
                                    <label for="" class="col-md-4">Employee Name</label>
                                    <div class="col-md-6">
                                        <select class="dropdwon_select  @error('employee_name') is-invalid @enderror" name="employee_name" id="employeeName" value="" >
                                            <option value="" selected>Please select</option>
                                            @foreach ($user as $row)
                                                <option value="{{$row->id}}">{{$row->name}} ( {{ $row->employee_code->employee_id }})</option>
                                            @endforeach
                                        </select>
                                        @error('employee_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">

                                    <!-- this is for employee name -->
                                    <div class="form-group col">

                                        <label class="row-lg col-form-label mt-0">Employee Name
                                            <span class="text-danger">*</span>
                                        </label>

                                        <div class="row-lg">
                                            <select class="dropdwon_select  @error('employee_name') is-invalid @enderror" name="employee_name" id="employeeName" value="" >
                                                <option value="" selected>Please select</option>
                                                @foreach ($user as $row)
                                                    <option value="{{$row->id}}">{{$row->name}} ( {{ $row->employee_code->employee_id }})</option>
                                                @endforeach
                                            </select>
                                            @error('employee_name')
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



                                <div class="col-lg-6">

                                    <!-- this is for department head -->
                                    <div class="form-group col">

                                        <label class="row-lg col-form-label">Employee Code
                                            <span class="text-danger">*</span>
                                        </label>

                                        <div class="row-lg">
                                            <input type="text" readonly id="employeeCode" class="form-control @error('emp_code') is-invalid @enderror" name="employee_code" placeholder="Enter Employee Code" value="{{old('emp_code')}}"> 

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

                                                <option value="1">Present</option>
                                                <option value="2">absent</option>
                                                
                                            </select>
                                        </div>

                                    </div>

                                </div>



                                <div class="col-lg-6">

                                    <!-- this is for start time -->
                                    <div class="form-group col">

                                        <label class="row-lg col-form-label">Start Time (HH : MM)
                                            <span class="text-danger">*</span>
                                        </label>

                                        <div class="row-lg">
                                            <input type="time" id="st_time" class="form-control @error('start_time') is-invalid @enderror" name="start_time" placeholder="Enter Employee Name" value="{{old('st_time')}}"> 

                                            @error('start_time')
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
                                            <input type="text" id="location" class="form-control @error('location') is-invalid @enderror" name="location" placeholder="Enter Location" value="{{old('loc')}}">                                     
                                            @error('location')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        

                                    </div>

                                </div>




                                <div class="col-lg-6">

                                    <!-- this is for location -->
                                    <div class="form-group col">

                                        <label class="row-lg col-form-label">End Time (HH : MM )
                                            <span class="text-danger">*</span>
                                        </label>

                                        <div class="row-lg">
                                            <input type="time" id="en_time" class="form-control @error('end_time') is-invalid @enderror" name="end_time" value="{{old('en_time')}}">

                                            @error('end_time')
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
                                           <select name="status" id="" class="form-control" @error('message') is-invalid @enderror>
                                            <option selected disabled>select a status</option>
                                            <option value="1">Active</option>
                                            <option value="0">In Active</option>
                                            </select>                                
                                            @error('status')
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
                                            <textarea class="form-control mt-1 @error('message') is-invalid @enderror" rows="1" id="rem" name="message" placeholder="Please Write Something..." value="{{old('rem')}}"></textarea>

                                            @error('message')
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

                            </div> --}}

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

    $('#employeeName').change(function(){
        var userId = $(this).val();
        employCode(userId);
    });

    function employCode(userId){
        $.ajax({
            url:'{{ route('get-employee-code') }}',
            method:'GET',
            dataType:"JSON",
            data:{userId},
            success:function(response){
                $('#employeeCode').val(response.employee_id);
            }
        });
    }

</script>

<script>
    var d = new Date()
    var yr =d.getFullYear();
    var month = d.getMonth()+1

    if(month<10){
        month='0'+month
    }

    var date =d.getDate();
    if(date<10)
    {
        date='0'+date
    }

    var c_date = yr+"-"+month+"-"+date;
    document.getElementById('date').value = c_date;
</script>

{{-- <script>
    $(document).on('change','#employee_name',function () {
        var employeeName = $(this).val();
       
        $.ajax({

            url:'/get-employee-code',
            method:'GET',
            dataType:"JSON",
            data:{'employee_name': employeeName},
            success:function(response) {
                console.log(response);
            }
        })
    })
</script> --}}