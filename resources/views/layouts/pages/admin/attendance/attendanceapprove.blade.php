<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Attendance approve<span class="bg-blue-500 text-white rounded px-1 text-xs py-0.5"></span></h4>
                    {{-- @can('Role create') --}}
                    {{-- <a href="" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i><span class="btn-icon-add"></span>Create</a> --}}
                    {{-- @endcan --}}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr class="align-center">
                                    <th>employee-ID</th>
                                    <th>Employee-Name</th>
                                    <th>Date</th>
                                    <th>Atten-type</th>
                                    <th>In-time</th>
                                    <th>Out-time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendance as $data )
                                <tr>
                                    <td>{{ $data->emp_code }}</td>
                                    <td>{{ $data->employee_name->name }}</td>
                                    <td>{{ $data->date }}</td>
                                    <td>
                                        @if ($data->attendance_type == 1)
                                            Present
                                            @else
                                            Absent

                                        @endif
                                    </td>
                                    <td>{{ $data->start_time }}</td>
                                    <td>{{ $data->end_time }}</td>
                                    <td class="d-flex justify-content-end">

                                        @if ($data['status'] == '1')
                                                <span class="badge light badge-success">Done</span>
                                            @elseif ($data['status'] == '2')
                                                <span class="badge light badge-danger">Cancel</span>
                                            @else

                                            <form action="{{ route('attendance_approval', $data['id']) }}" method="POST">
                                                <button class="badge badge-success mr-2">Approve</button>
                                                @csrf
                                                @method('PATCH')
                                            </form>
                                            <form action="{{ route('attendance_decline', $data['id']) }}" method="POST">
                                                <button class="badge badge-danger">Cancel</button>
                                                @csrf
                                                @method('PATCH')
                                            </form>
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
