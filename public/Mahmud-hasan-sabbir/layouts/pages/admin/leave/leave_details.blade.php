<x-app-layout>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Leave Details<span class="bg-blue-500 text-white rounded px-1 text-xs py-0.5"></span></h4>
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

</x-app-layout>
