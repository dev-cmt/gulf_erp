<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\HrAttendance;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AttendanceImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new HrAttendance([
            "date"              => $row['date'],
            "in_time"           => $row['in'],
            "out_time"          => $row['out'],
            "location"          => $row['location'],
            "description"       => $row['description'],
            "attendance_type"   => 1,
            // "status"            => $row[6],
            // "finger_id"         => $row[7],
            "emp_id"            => 1,
            "user_id"           => Auth::user()->id,
        ]);

    }
}
