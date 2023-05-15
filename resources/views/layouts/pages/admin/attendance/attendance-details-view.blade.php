<table class="table table-bordered table-responsive-sm" style="min-width: 500px">
    <div class="d-flex justify-content-between">
        <div>
            <span class="mr-2" style="font-weight: 700;margin:20px 0px">Employee Name :</span><label class="col-form-label">{{ $user->name }}</label>
        </div>
        <a href="{{route('attendance.export')}}" class="btn btn-rounded btn-warning"><span class="btn-icon-left text-warning"><i class="fa fa-download color-warning"></i></span>Download</a>
    </div>
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
        @foreach ($data as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->date }}</td>
                <td>{{ $row->start_time }}</td>
                <td>{{ $row->start_time }}</td>
                <td>{{ $row->end_time }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
