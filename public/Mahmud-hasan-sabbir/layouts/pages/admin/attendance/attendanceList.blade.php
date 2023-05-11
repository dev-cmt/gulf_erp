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
                                @foreach ($data as $row )
                                <tr>
                                    <td></td>
                                    <td>{{ $row->start_time}}</td>
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
                        <table id="example3" class="display">
                            <thead>
                                <tr>
                                    <th>SL NO</th>
                                    <th>Date</th>
                                    <th>Day type</th>
                                    <th>In time</th>
                                    <th>Out time</th>
                                </tr>
                            </thead>
                            <tbody>
                               <td>1</td>
                               <td>05/10/2023</td>
                               <td>p</td>
                               <td>09:27:49</td>
                               <td>05:02:49</td>
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
