<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Attendance List</h4>
                    @can('Role create') 
                        <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg_form"><i class="fa fa-plus"></i><span class="btn-icon-add" data-bs-toggle="modal"></span>Manual Attendance</a>                   
                    @endcan
                </div>
                
                <div class="card-body">
                    <div class="row" id="filter-data">
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-md-5 col-form-label">Employee Name
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-7">
                                    <select name="user_id" id="user_id" class="form-control dropdwon_select">
                                        <option selected disabled>--Select--</option>
                                        @foreach($employee as $row)
                                            <option value="{{ $row->id}}">{{ $row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-md-5 col-form-label">Start Date
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-7">
                                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('date') ? old('date'):  date('Y-m-d') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-md-5 col-form-label">End Date
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-7">
                                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('date') ? old('date'):  date('Y-m-d') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div>
                                <button id="filter" class="btn btn-primary">Filter</button>
                                <button id="reset" class="btn btn-warning">Reset</button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Date</th>
                                    <th>In Time</th>
                                    <th>Out Time</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                @foreach ($data as $key=> $row )
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $row->date }}</td>
                                    <td>{{ $row->in_time }}</td>
                                    <td>{{ $row->out_time }}</td>
                                    <td class="d-flex justify-content-end">
                                        <a href="{{route('get_employee_repot',$row->id)}}" class="btn btn-sm btn-success p-1 px-2 view_report"><i class="fa fa-folder-open"></i><span class="btn-icon-add"></span>View</a>
                                    </td>
                               </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Attendances Application Modal -->
    <div class="modal fade bd-example-modal-lg_form" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                @if (session()->has('success'))
                    <strong class="text-success">{{session()->get('success')}}</strong>
                @endif
                <form class="form-valide" action="{{ route('manual_attendances.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Manual Attendance</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body row">
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
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
                        $('.bd-example-modal-lg_form').modal('hide');

                        //---Add Table Row
                        var row = '<tr id="row_todo_'+ response.id + '">';
                        row += '<td>' + response.name + '</td>';
                        row += '<td>' + response.leave_name + '</td>';
                        row += '<td>' + response.formattedDate1 + '</td>';
                        row += '<td>' + response.formattedDate2 + '</td>';
                        row += '<td>' + response.duration + '</td>';
                        row += '<td class="d-flex justify-content-end"> @if('+response.status == 0 +') <span class="badge light badge-warning"><i class="fa fa-circle text-warning mr-1"></i>Pending</span> @elseif ('+ response.qualification == 1+') <span class="badge light badge-success"><i class="fa fa-circle text-success mr-1"></i>Successful</span> @elseif ('+ response.qualification == 2+') <span class="badge light badge-danger"><i class="fa fa-circle text-danger mr-1"></i>Canceled</span> @endif' + '</td>';
                        
                        if($("#id").val()){
                            $("#row_todo_" + response.id).replaceWith(row);
                        }else{
                            $("#list_todo").prepend(row);
                        }
                        $("#form_todo").trigger('reset');
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
                            title: 'Required data missing?',
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
        var month = d.getMonth()+1;
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
@endpush
</x-app-layout>


<script>
    $(function() {
        $("#start_date").datepicker({
            "dateFormat": "yy-mm-dd"
        });
        $("#end_date").datepicker({
            "dateFormat": "yy-mm-dd"
        });
    });
    // Fetch records
    function fetch(start_date, end_date) {
        $.ajax({
            url: "{{ route('get-attendance-filter') }}",
            type: "GET",
            data: {
                start_date: start_date,
                end_date: end_date
            },
            dataType: "json",
            success: function(response) {
                // alert(response);
                var tableBody = $('#table-body');
                tableBody.empty();
                $.each(response, function(index, item) {
                    alert(item.date);
                    var row = '<tr>';
                    row += '<td>' + item.date + '</td>';
                    row += '<td>' + item.in_time + '</td>';
                    row += '<td>' + item.out_time + '</td>';
                    row += '<td></td>';
                    row += '</tr>';
                    tableBody.prepend(row);
                });
                
            }
        });
    }
    // Filter
    $(document).on("click", "#filter", function(e) {
        e.preventDefault();
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();
        alert('click');

        if (start_date == "" || end_date == "") {
            alert("Both date required");
        } else {
            $('#records').DataTable().destroy();
            fetch(start_date, end_date);
        }
    });
    // Reset
    $(document).on("click", "#reset", function(e) {
        e.preventDefault();
        $("#start_date").val(''); // empty value
        $("#end_date").val('');
        $('#records').DataTable().destroy();
        fetch();
    });
    $('#filter-data').on('input', '#start_date, #end_date', function() {

    });
</script>










