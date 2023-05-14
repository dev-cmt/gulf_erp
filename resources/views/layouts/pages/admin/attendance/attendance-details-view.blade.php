<table id="" class="display table table-hover " style="min-width: 500px">
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
        @foreach ($attendanceList as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->date }}</td>
                <td>{{ $data->start_time }}</td>
                <td>{{ $data->start_time }}</td>
                <td>{{ $data->end_time }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
