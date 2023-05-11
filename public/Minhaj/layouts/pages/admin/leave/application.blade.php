<x-app-layout>


    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Self Leave</h5>
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
                                                <option value="3">Casual Leave</option>
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
                                            {{$single_data->desig_name}}
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
                            <div class="modal-footer" style="height:20px">
                                <button type="button" class="btn btn-sm btn-danger light mt-4" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-sm btn-primary mt-4" id="output">Save</button>
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
                            @foreach($data as $row)
                            <tr>

                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>
                                    <?php
                                            if ($row->leave_type == 1)
                                                {
                                                    echo 'Sick leave';
                                                }elseif ($row->leave_type == 2)
                                                {
                                                    echo 'Rest Leave';
                                                }elseif ($row->leave_type == 3)
                                                {
                                                    echo 'Casual Leave';
                                                }else{
                                                echo 'good night';
                                            }
                                            ?>
                                    </td>
                                    <td>{{ $row->start_date }}</td>
                                    <td>{{ $row->end_date }}</td>

                                    <td></td>
                                    

                                    <td class="d-flex justify-content-end">
                                        @if($row->status == 0)
                                            <a class="btn btn-success btn-xs">Processing</a>
                                        @elseif($row->status == 1)
                                            <a class="btn btn-success btn-xs">Approve</a>
                                        @elseif($row->status == 2)
                                            <a class="btn btn-success btn-xs">Cancel</a>
                                        @endif


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


</x-app-layout>



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
    document.getElementById('dateTwo').value = c_date;
</script>


