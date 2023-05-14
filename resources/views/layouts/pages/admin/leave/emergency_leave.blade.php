<x-app-layout>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Emergency Leave Application<span class="bg-blue-500 text-white rounded px-1 text-xs py-0.5"></span></h4>
                    @can('Role create')
                    <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Skip</a>
                    @endcan
                </div>
                <div class="card-body">
                    @if (session()->has('success'))
                        <strong class="text-success">{{session()->get('success')}}</strong>
                    @endif
                    <form class="form-valide" data-action="{{ route('leave_application.store') }}" method="POST" enctype="multipart/form-data" id="add-user-form">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-lg-5 col-form-label">Employee Name</label>
                                    <div class="col-lg-7">
                                        <select class="form-control dropdwon_select" id="employeeName" name="emp_id">
                                            <option selected>Select</option>
                                            @foreach ($employee as $row)
                                                <option value="{{$row->id}}">{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-lg-5 col-form-label">Employee Code</label>
                                    <div class="col-lg-7">
                                        <label class="col-lg-7 col-form-label" id="employeeCode">GULF-XXXXX</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-lg-5 col-form-label">Start Date
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-7">
                                        <input type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" placeholder="Enter Date.." value="{{old('start_date')}}" id="start_date">
                                        @error('start_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-lg-5 col-form-label">End Date
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-7">
                                        <input type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{old('end_date')}}" id="end_date">
                                        @error('end_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-lg-5 col-form-label">Leave Type
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-7">
                                        <select class="form-control default-select" id="leave_type" name="leave_type">
                                            <option disabled selected>Please select</option>
                                            @foreach ($leave_type as $row)
                                                <option value="{{$row->id}}">{{$row->leave_name}}</option>
                                            @endforeach
                                        </select> 
                                        @error('leave_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-lg-5 col-form-label">Contact Number
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-7">
                                        <input type="number" class="form-control @error('leave_contact') is-invalid @enderror" name="leave_contact" value="{{old('leave_contact')}}">
                                        @error('leave_contact')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-lg-5 col-form-label">Leave Location</label>
                                    <div class="col-lg-7">
                                        <input type="text" class="form-control @error('leave_location') is-invalid @enderror" name="leave_location" placeholder="Enter location.." value="{{old('location')}}">
                                        @error('start_dates')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-lg-5 col-form-label">Leave Purpose</label>
                                    <div class="col-lg-7">
                                        <input type="text" class="form-control @error('purpose') is-invalid @enderror" name="purpose" placeholder="Enter purpose.." value="{{old('purpose')}}">
                                        @error('start_dates')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary fload-right">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @push('script')
    <script>
        $(document).ready(function(){
            //---Save Data
            var form = '#add-user-form';
            $(form).on('submit', function(event){
                event.preventDefault();

                var url = $(this).attr('data-action');
                var src = $('#redirect').attr('redirect-action');
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
                        swal("Success Message Title", "Well done, you pressed a button", "success")
                        $("#add-user-form").trigger('reset');
                        $("#leave_application_list").load(" #leave_application_list");
                    },
                    error: function (xhr) {
                        var errors = xhr.responseJSON.errors;
                        var errorHtml = '';
                        $.each(errors, function(key, value) {
                            errorHtml += '<li style="color:red">' + value + '</li>';
                        });
                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Errors',
                            html: '<ul>' + errorHtml + '</ul>',
                        });
                    }
                });
            });
        });

        $(document).ready(function(){
            $.ajaxSetup({
                headers:{
                    'x-csrf-token' : $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
    <script>
        //----Current Date
        var d = new Date()
        var yr =d.getFullYear();
        var month = d.getMonth()+1
    
        if(month<10){month='0'+month}
        var date =d.getDate();
        if(date<10){date='0'+date}
    
        var c_date = yr+"-"+month+"-"+date;
        document.getElementById('start_date').value = c_date;
        document.getElementById('end_date').value = c_date;
    </script>
    @endpush

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