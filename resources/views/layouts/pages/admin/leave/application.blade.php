<x-app-layout>


    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Leave Application</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                        <p class="text-center text-success">{{Session::get('message')}}</p>
                        <form class="form-valide" action="{{route('leave.store')}}" method="post" enctype="multipart/form-data" name="form">
                            @csrf
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-name">Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" id="val-name" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter name.." value="{{old('name')}}">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Start Date
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="date" class="form-control @error('date') is-invalid @enderror" name="start_date" placeholder="Enter Date.." value="{{old('date')}}" id="inputOne">
                                            @error('date')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Leave Type
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select name="leave_type" class="form-control default-select  @error('leave_type') is-invalid @enderror" style="height: 40px;">
                                                <option value="1">Sick Leave</option>
                                                <option value="2">Rest Leave</option>
                                                <option value="3">Festival Leave</option>
                                                <option value="4">Check Leave</option>
                                            </select>
                                            @error('type_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Leave Location</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control @error('location') is-invalid @enderror" name="leave_location" placeholder="Enter location.." value="{{old('location')}}">
                                            @error('location')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Designation</label>
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
                                        <label class="col-lg-4 col-form-label">End Date
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="date" id="inputTwo" class="form-control @error('date') is-invalid @enderror" name="end_date" placeholder="Enter Date.." value="{{old('date')}}">
                                            @error('date')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Leave Contact</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control @error('contact') is-invalid @enderror" name="leave_contact" placeholder="Enter Contact.." value="{{old('contact')}}">
                                            @error('contact')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Purpose</label>
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
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-danger light" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-sm btn-primary" id="output">Save</button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Self Leave<span class="bg-blue-500 text-white rounded px-1 text-xs py-0.5"></span></h4>
                    {{-- @can('Role create') --}}
                    <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-plus"></i><span class="btn-icon-add" data-bs-toggle="modal"></span>Create</a>
                    {{-- @endcan --}}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                            <tr>
                                <th>SL NO</th>
                                <th>Employee Name</th>
                                <th>Leave Type</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Duration</th>
                                <th class="text-right">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($applicationData as $data)
                            <tr>

                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>
{{--                                        {{ $data->leave_type }}--}}
                                    <?php
                                            if ($data->leave_type == 1)
                                                {
                                                    echo 'Sick leave';
                                                }elseif ($data->leave_type == 2)
                                                {
                                                    echo 'Rest Leave';
                                                }elseif ($data->leave_type == 3)
                                                {
                                                    echo 'Festival Leave';
                                                }else{
                                                echo 'good night';
                                            }
                                            ?>
                                    </td>
                                    <td>{{ $data->start_date }}</td>
                                    <td>{{ $data->end_date }}</td>
                                    <td>
<!--                                        --><?php
//                                        $fdate = $data_request->start_date;
//                                        $tdate = $data_request->end_date;
//                                        $datetime1 = new DateTime($fdate);
//                                        $datetime2 = new DateTime($tdate);
//                                        $interval = $datetime1->diff($datetime2);
//                                        $days = $interval->format('%a');
//                                        ?>
                                    </td>
                                    <td class="d-flex justify-content-end">
                                        @if($data->status == 0)
                                            <a class="btn btn-success btn-xs">Processing</a>
                                        @elseif($data->status == 1)
                                            <a class="btn btn-success btn-xs">Approve</a>
                                        @elseif($data->status == 2)
                                            <a class="btn btn-success btn-xs">Cancel</a>
                                        @endif


                                    </td>

{{--                                <td class="d-flex justify-content-end">--}}
{{--                                    @can('User edit')--}}
{{--                                        <a href="{{ route('lose_member.edit', $row->id) }}" class="btn btn-success shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>--}}
{{--                                    @endcan--}}
{{--                                    @can('User delete')--}}
{{--                                        <form action="{{ route('lose_member.destroy', $row->id) }}" method="POST">--}}
{{--                                            @method('DELETE')--}}
{{--                                            @csrf--}}
{{--                                            <button class="btn btn-danger shadow btn-xs sharp" onclick="return confirm('Are you sure?');" type="submit"><i class="fa fa-trash"></i></button>--}}
{{--                                        </form>--}}
{{--                                    @endcan--}}
{{--                                </td>--}}
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

{{--    <script>--}}
{{--        function calculateDays() {--}}
{{--            var startOne = document.getElementById('inputOne').value;--}}
{{--            var startTwo = document.getElementById('inputTwo').value;--}}
{{--            const dateOne = new Date(startOne);--}}
{{--            const dateTwo = new Date(startTwo);--}}
{{--            const time = Math.abs(dateTwo - dateOne);--}}
{{--            const days = Math.ceil(time/(1000*60*60*24));--}}
{{--            // var x = document.getElementById("output").innerHTML = days;--}}
{{--            alert(dateOne);--}}

{{--        }--}}
{{--    </script>--}}
</x-app-layout>


