<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- card header -->
                <div class="card-header">
                    <h4 class="card-title">Manual Attendance</h4>
                    <a href="{{route('manual_attendances.index')}}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                </div>
                <!-- card body -->
                <div class="card-body">
                    <div class="form-validation">
                        <!-- this is for validation checking message -->
                        @if (session()->has('success'))
                            <strong class="text-success">{{session()->get('success')}}</strong>
                        @endif
                        <form class="form-valide" action="{{ route('manual_attendances.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Employee Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-8">
                                            <select class="form-control dropdwon_select @error('emp_id') is-invalid @enderror" id="employeeName" name="emp_id" required>
                                                <option selected disabled>Select</option>
                                                @foreach ($employee as $row)
                                                    <option value="{{$row->id}}" {{ old('emp_id') == $row->id ? 'selected' : '' }}>{{$row->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('emp_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Employee Code</label>
                                        <div class="col-lg-8">
                                            <label class="col-form-label" id="employeeCode">GULF-XXXXX</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Date
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-8">
                                            <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{old('date')}}">
                                            @error('date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Attendance Type
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-8">
                                            <select class="form-control default-select @error('attendance_type') is-invalid @enderror" name="attendance_type" required>
                                                <option disabled selected> Select </option>
                                                <option value="1" {{ old('attendance_type') == '1' ? 'selected' : '' }}>Present</option>
                                                <option value="0" {{ old('attendance_type') == '2' ? 'selected' : '' }}>Absent</option>
                                            </select>
                                            @error('attendance_type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">In Time (hh:mm)
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-8">
                                            <input type="time" class="form-control @error('in_time') is-invalid @enderror" name="in_time" value="09:00">
                                            @error('in_time')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Out Time (hh:mm)
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-8">
                                            <input type="time" class="form-control @error('out_time') is-invalid @enderror" name="out_time" value="17:00">
                                            @error('out_time')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Location</label>
                                        <div class="col-lg-8">
                                            <textarea  id="" cols="30" rows="2" class="form-control @error('location') is-invalid @enderror" name="location" placeholder="Please Write Something...">{{old('location')}}</textarea>
                                            @error('location')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Remarks</label>
                                        <div class="col-lg-8">
                                            <textarea  id="" cols="30" rows="2" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Please Write Something...">{{old('description')}}</textarea>
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row mt-1">
                                        <label for="" class="col-md-8"></label>
                                        <button type="submit" class="btn btn-success btn-sm" style="margin-left: 270px">Submit</button>
                                    </div>
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
    $('#employeeName').change(function(){
        var userId = $(this).val();
        $.ajax({
            url:'{{ route('get_employee_code') }}',
            method:'GET',
            dataType:"JSON",
            data:{userId},
            success:function(response){
                $('#employeeCode').html(response.employee_code);
            }
        });
    });
</script>
<script>
    //----Current Date
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