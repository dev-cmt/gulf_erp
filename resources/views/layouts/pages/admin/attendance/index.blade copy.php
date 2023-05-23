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
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Employee Code</th>
                                    <th>Employee-Name</th>
                                    <th>Email</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key=> $row )
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $row->employee_code }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->email }}</td>
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

    <!-- Modal Start-->
    {{-- <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Attendance List</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body pt-0">
                    <div id="responce_attendence">

                    </div>
                </div>
            </div>
        </div>
    </div> --}}

</x-app-layout>
{{-- <script>
    $('.table-responsive').on('click','.view_report',function(){
        let attendence_id = $(this).data('id');
        $.get('get/employee_repot/'+ attendence_id,function(data){
            $("#responce_attendence").html(data)
        });
    });
</script> --}}


