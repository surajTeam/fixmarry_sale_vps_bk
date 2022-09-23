<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Http\Controllers\Controller;
use App\Models\SalesEmployee;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function showAttendancePage() {
    	$days = $this->days(date("m"), date('Y'));
    	$month = date("m");
        $year = date("Y");

        $now = strtotime(date("Y-m-d")); // or your date as well
        $your_date = strtotime(date("Y-m")."-01");
        $datediff = $now - $your_date;
        $total_days = round($datediff / (60 * 60 * 24))+1;

    	$employees = SalesEmployee::where('id', '!=', 1)->get();
    	return view('admin.employee.attendance', compact('days', 'employees', 'month', 'year', 'total_days'));
    }

    private function days($month, $year) {
    	return cal_days_in_month(CAL_GREGORIAN	, $month, $year);
    }
}
