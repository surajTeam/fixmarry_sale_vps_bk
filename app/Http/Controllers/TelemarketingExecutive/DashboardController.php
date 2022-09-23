<?php

namespace App\Http\Controllers\TelemarketingExecutive;

use App\Http\Controllers\Controller;
use App\Models\SalesEmployee;
use App\Models\SalesEmployeeAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function showDashboard() {
    	$tme = SalesEmployee::select('name', 'profile_photo_url')->where('id', Session::get('sales_employee_id'))->first();
    	// print_r($tme);
    	return view('tme.dashboard', compact('tme'));
    }

    public function showAttendanceDashboard() {
    	$attendances = SalesEmployeeAttendance::where('employee_id', Session::get('sales_employee_id'))->orderBy('id', 'DESC')->get();
    	return view('attendance.dashboard', compact('attendances'));
    }
}
