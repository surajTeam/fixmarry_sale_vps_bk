<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\SalesEmployeeAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EmployeeAttendanceController extends Controller
{
	

    public function showPunchInPage() {
        if(Helper::check_punch_in()) {
            return redirect('/');
        } else {
            return view('attendance.punch_in');
        }
    	
    }

    public function punchIn(Request $request) {
    	
    	$attendance = SalesEmployeeAttendance::create([
    		'employee_id' => Session::get('sales_employee_id'),
    		'date' => date("Y-m-d"),
    		'punch_in_time' => date("H:i:s"),
    	]);

    	if ($attendance) {
    		return true;
    	}
    }

    public function showPunchOutPage() {
        if(Helper::check_punch_in()) {
            $attendance = SalesEmployeeAttendance::where("employee_id",Session::get('sales_employee_id'))->where('date', date("Y-m-d"))->first();
            return view('attendance.punch_out', compact('attendance'));
        } else {
            return redirect()->back();
        }
    }

    public function punchOut(Request $request) {
        
        return $punch_out = SalesEmployeeAttendance::where("employee_id",Session::get('sales_employee_id'))->where('date', date("Y-m-d"))->update(["punch_out_time" => date("H:i:s")]);
        
        if($punch_out) {
           
            return true;
        }
        
    }
}
