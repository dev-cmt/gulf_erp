{{-- <x-app-layout> --}}
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
{{-- </x-app-layout> --}}