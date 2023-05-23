<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Attendance List</h4>
                    @can('Role create')                    
                        <a href="{{ route('manual_attendances.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i><span class="btn-icon-add"></span>Manual Attendance</a>
                    @endcan
                </div>
                <div class="card-body">
                    <form class="row" action="{{ route('manual_attendances.store') }}" method="POST" enctype="multipart/form-data">
                        <div class="col-lg-4">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Employee Name</label>
                                <div class="col-lg-6">
                                    <select class="form-control dropdwon_select" id="employeeName" name="emp_id" required>
                                        <option selected disabled>Select</option>
                                        @foreach ($employee as $row)
                                            <option value="{{$row->id}}" {{ old('emp_id') == $row->id ? 'selected' : '' }}>{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 d-flex justify-content-end">
                            <div class="form-group row mr-2">
                                <label class="col-lg-4 col-form-label">Start Date</label>
                                <div class="col-lg-8">
                                    <input type="date" class="form-control" name="start_date" value="{{old('date')}}">
                                </div>
                            </div>
                            <div class="form-group row mr-2">
                                <label class="col-lg-4 col-form-label">End Date</label>
                                <div class="col-lg-8">
                                    <input type="date" class="form-control" name="end_date" value="{{old('date')}}">
                                </div>
                            </div>
                            <div class="form-group row mr-4">
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Date</th>
                                    <th>In Time</th>
                                    <th>Out Time</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
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
                    {{-- {{ $data->links() }} --}}
                    {{-- {{ $data->links('vendor.pagination.custom') }} --}}
                    {{ $data->links('vendor.pagination.bootstrap-5') }}
                </div>

            </div>
        </div>
    </div>

</x-app-layout>


