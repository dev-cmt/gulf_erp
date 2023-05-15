<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;
use App\Models\Admin\HrAttendance;
use Maatwebsite\Excel\Concerns\ToModel;

class AttendanceImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new HrAttendance([
            "date"              => $row[0],
            "start_time"        => $row[1],
            "end_time"          => $row[2],
            "location"          => $row[3],
            "description"       => $row[4],
            "attendance_type"   => $row[5],
            "status"            => $row[6],
            "emp_id"            => $row[7],
            "user_id"           => $row[8],
        ]);

    }
}
