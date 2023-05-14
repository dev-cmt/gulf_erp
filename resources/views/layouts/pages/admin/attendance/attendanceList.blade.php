<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Attendance List<span class="bg-blue-500 text-white rounded px-1 text-xs py-0.5"></span></h4>
                    {{-- @can('Role create') --}}
                    {{-- <a href="" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i><span class="btn-icon-add"></span>Create</a> --}}
                    {{-- @endcan --}}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>Employee ID</th>
                                    <th>Employee-Name</th>
                                    <th>Atten-Type</th>
                                    <th> In-Time</th>
                                    <th> Out-Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendance as $data )
                                <tr>
                                    <td>{{ $data->emp_code }}</td>
                                    <td>{{ $data->employee_name->name }}</td>
                                    <td>
                                        @if ($data->attendance_type == 1)
                                            Present
                                            @else
                                            Absent

                                        @endif
                                    </td>
                                    <td>{{ $data->start_time }}</td>
                                    <td>{{ $data->end_time }}</td>
                                    <td>
                                        <a href="" class="view_report btn btn-success" data-toggle="modal" data-id="{{ $data->emp_id }}" data-target=".bd-example-modal-lg"><i class="fa fa-folder-open "></i><span class="btn-icon-add view_report" data-bs-toggle="modal"></span>View</a>
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

    <!-- modal start-->

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Attendance List</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div id="responce_attendence">

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
<script>
    $('.table-responsive').on('click','.view_report',function(){
        let attendence_id = $(this).data('id');
        $.get('get-employee-repot/'+attendence_id,function(data){
            $("#responce_attendence").html(data)
        });
    });
</script>


