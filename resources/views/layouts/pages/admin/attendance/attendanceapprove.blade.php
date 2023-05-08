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
                                <tr>
                                    <th>Employee Name</th>
                                    <th>Employee code</th>
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                <tr>
                                    <td>fgjghjg</td>
                                     <td>678678</td>
                                     <td>hr</td>
                                    <td>jlshfs</td>
                                    <td>
                                        <a href="" class="btn btn-success btn-sm">approve</a>
                                        <a href="" class="btn btn-danger btn-sm">cancel</a>
                                     </td>
                                </tr>
                               
                               
                                
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
