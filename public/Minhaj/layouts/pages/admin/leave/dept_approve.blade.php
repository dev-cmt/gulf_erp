<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Dept. Approve<span class="bg-blue-500 text-white rounded px-1 text-xs py-0.5"></span></h4>
                    {{-- @can('Role create') --}}
                    {{--                    <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i><span class="btn-icon-add"></span>Create</a>--}}
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
                                    @php
                                    $startDate = \Carbon\Carbon::parse($data->start_date);
                                    $endDate = \Carbon\Carbon::parse($data->end_date);
                                    $diffInDays = $startDate->diffInDays($endDate);
                                    @endphp
                                    <td>{{ $diffInDays }}</td>

                                    <td class="d-flex justify-content-end">
                                    
                                            <form action="{{ route('leave.approve', $data->id) }}" method="post">
                                                <button class="badge badge-success mr-2">Approve</button>
                                                @csrf
                                                @method('PATCH')
                                            </form>
                                            <form action="{{ route('leave.decline', $data->id) }}" method="post">
                                                <button class="badge badge-danger">Cancel</button>
                                                @csrf
                                                @method('PATCH')
                                            </form>

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
