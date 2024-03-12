<x-reports-layout>
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #ffffff;
        }

        .bg-white {
            flex: 1;
            padding-bottom: 50px;
        }
        .footer {
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .table th, .table td {
            padding: 0px 10px !important;
        }
    </style>
    @php
        // Set up date range
        $startDate = new DateTime($data->salary_year . '-' . $data->salary_month . '-01');
        $endDate = new DateTime($data->salary_year . '-' . $data->salary_month . '-' . cal_days_in_month(CAL_GREGORIAN, $data->salary_month, $data->salary_year));

        $attendanceData = $data->user->hrAttendance()
            ->whereBetween('date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
            ->selectRaw('SUM(is_late = 1) as lateAttendance, COUNT(*) as totalAttendance, SUM(CASE WHEN status = 0 THEN 1 ELSE 0 END) as `absent`, SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) as `present`, SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) as `leave`, SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) as govtVacation')
            ->first();

        $lateCount = round($attendanceData->lateAttendance / 3);
        $absentCount = $attendanceData->absent;
        $presentCount = $attendanceData->present;
        $govtVacationCount = $attendanceData->govtVacation;
        $leaveCount = $attendanceData->leave;


        // Total Month
        $daysInMonth = $startDate->format('t');

        $interval = new DateInterval('P1D');
        $expectedDates = array_map(fn ($date) => $date->format('Y-m-d'), iterator_to_array(new DatePeriod($startDate, $interval, $endDate->modify('+1 day'))));

        // Vacation Count -->>|| 5 => Friday || 6 => Saturday
        $weeklyVacationCount = count(array_filter($expectedDates, function ($date) {
            $dayOfWeek = (new DateTime($date))->format('N');
            return $dayOfWeek == 5; // return $dayOfWeek == 5 || $dayOfWeek == 6;
        }));

        $unauthorized = $daysInMonth - (($presentCount + $absentCount) + ($weeklyVacationCount + $leaveCount + $govtVacationCount));
        if ($unauthorized < 0) {
            $unauthorized = 0;
        }
    @endphp 
    <div class="bg-white">
        <div class="d-flex justify-content-center">
            <div class="text-center">
                <h3>Payslip</h3>
                <h6>Icon Information Systems Ltd.</h6>
                <h6>Tower 2, Suite # 12/D, Confidence Centre,</h6>
                <h6> Dhaka 1212</h6>
            </div>
        </div>
        <table class="table table-borderless">
            <tr>
                <td><strong> Employee Name </strong></td>
                <td>{{$data->user->name}}</td>
                <td><strong> Total Day </strong></td>
                <td>{{$daysInMonth}} Day</td>
            </tr>
            <tr>
                <td><strong> Date Of Joining </strong></td>
                <td>{{date("j F, Y", strtotime($data->user->infoPersonal->joining_date))}}</td>
                <td><strong> Working </strong></td>
                <td>{{$presentCount}} Day</td>
            </tr>
            <tr>
                <td><strong> Department </strong></td>
                <td>{{$data->user->infoPersonal->mastDepartment->dept_name}}</td>
                <td><strong> Leave </strong></td>
                <td>{{$leaveCount}} Day</td>
            </tr>
            <tr>
                <td><strong> Designation </strong></td>
                <td>{{$data->user->infoPersonal->mastDesignation->desig_name}}</td>
                <td><strong> Govt. Holiday </strong></td>
                <td>{{$govtVacationCount}} Day</td>
            </tr>
            <tr>
                <td><strong> Pay Period </strong></td>
                <td>{{ date("j F, Y", strtotime($data->salary_year . '-' . $data->salary_month . '-01')) }}</td>
                <td><strong> Month Of Week </strong></td>
                <td>{{$weeklyVacationCount}} Day</td>
            </tr>
        </table>
        <br>
        <div class="table-responsive">
            <table id="items-table" class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Earnings</th>
                        <th>Amount</th>
                        <th>Deducions</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Basic</strong></td>
                        <td class="text-right">{{$data->basic_pay}}</td>
                        <td><strong>Late</strong></td>
                        <td class="text-right">{{( $data->basic_pay / 30 ) * $lateCount}}</td>
                    </tr>
                    <tr>
                        <td><strong>House Rent</strong></td>
                        <td class="text-right">{{$data->house_rent_pay}}</td>
                        <td><strong>Unauthorized Absent</strong></td>
                        <td class="text-right">{{( $data->basic_pay / 30 ) * $unauthorized}}</td>
                    </tr>
                    <tr>
                        <td><strong>Medical Pay</strong></td>
                        <td class="text-right">{{$data->medical_pay}}</td>
                        <td><strong>Leave Without Pay</strong></td>
                        <td class="text-right">{{( $data->basic_pay / 30 ) * $absentCount}}</td>
                    </tr>
                    <tr>
                        <td><strong>Conveyance Pay</strong></td>
                        <td class="text-right">{{$data->conveyance_pay}}</td>
                        <td></td>
                        <td class="text-right"></td>
                    </tr>
                    <tr>
                        <td><strong>Additional Pay</strong></td>
                        <td class="text-right">{{$data->additional_pay}}</td>
                        <td></td>
                        <td class="text-right"></td>
                    </tr>
                    <tr>
                        <td class="text-right"><strong>Total Earnings</strong></td>
                        <td class="text-right">
                            {{ number_format(($data->basic_pay ?? 0) + ($data->house_rent_pay ?? 0) + ($data->medical_pay ?? 0) + ($data->conveyance_pay ?? 0) + ($data->additional_pay ?? 0), 2) }}
                        </td>
                        <td class="text-right"><strong>Total Deducions</strong></td>
                        <td class="text-right">{{$data->dedaction}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-right"></td>
                        <td><strong>Net Pay</strong></td>
                        <td class="text-right">{{$data->net_pay}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br><br>
        <div class="text-center">
            <h6 id="get-net-salary">{{$data->net_pay}}</h6>
            <h6>
                <?php
                    $number = $data->net_pay;
                    $number1 = $number;
                    $no = floor($number);
                    $hundred = null;
                    $digits_1 = strlen($no); //to find lenght of the number
                    $i = 0;
                    // Numbers can stored in array format
                    $str = array();

                    $words = array('0' => '', '1' => 'One', '2' => 'Two',
                    '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
                    '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
                    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
                    '13' => 'Thirteen', '14' => 'Fourteen',
                    '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
                    '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
                    '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
                    '60' => 'Sixty', '70' => 'Seventy',
                    '80' => 'Eighty', '90' => 'Ninety');

                    $digits = array('', 'Hundred', 'Thousand', 'lakh', 'Crore');

                    while ($i < $digits_1){
                        $divider = ($i == 2) ? 10 : 100;
                        //Round numbers down to the nearest integer
                        $number =floor($no % $divider);
                        $no = floor($no / $divider);
                        $i +=($divider == 10) ? 1 : 2;

                        if ($number){
                            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                            $str [] = ($number < 21) ? $words[$number] . " " .
                            $digits[$counter] .
                            $plural . " " .
                            $hundred: $words[floor($number / 10) * 10]. " " .
                            $words[$number % 10] . " ".
                            $digits[$counter] . $plural . " " .
                            $hundred;
                        }else $str[] = null;
                    }

                    $str = array_reverse($str);
                    $result = implode('', $str);
                    echo $result. "Taka." ;
                ?>
            </h6>
        </div>
    </div>
    
    <div class="footer">
        <table class="table table-borderless">
            <tr>
                <td></td>
                <td class="text-center">
                    <h5 style="border-bottom:1px solid #222;padding-bottom:40px">Employee Signature</h5>
                </td>
                <td></td>
                <td></td>
                <td class="text-center">
                    <h5 style="border-bottom:1px solid #222;padding-bottom:40px">Employee Signature</h5>
                </td>
                <td></td>
            </tr>
        </table>
    </div>
    
    
    
    
</x-reports-layout>