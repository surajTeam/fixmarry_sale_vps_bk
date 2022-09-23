<?php

namespace App\Helpers;

use App\Models\SalesEmployeeAttendance;
use App\Models\SalesRole;
use Illuminate\Support\Facades\Session;

class Helper {

	public static function role_id($role_name) {
		return $role_id = SalesRole::where('name', $role_name)->first()['id'];
	}

	public static function check_punch_in() {
		return SalesEmployeeAttendance::where("date",date("Y-m-d"))->where("employee_id", Session::get('sales_employee_id'))->exists();
	}

	public  static function check_day_present($day, $month, $year, $employee_id) {
		if($day < 10) {
			$day = "0".$day;
		}
		$full_date = $year."-".$month."-".$day;
		
		return SalesEmployeeAttendance::where("date", $full_date)->where("employee_id", $employee_id)->exists();
	}

	public static function attendance_info($day, $month, $year, $employee_id) {
		if($day < 10) {
			$day = "0".$day;
		}
		$full_date = $year."-".$month."-".$day;
		return SalesEmployeeAttendance::where("date", $full_date)->where("employee_id", $employee_id)->first();
	}

	public static function present_count($date) {
		return SalesEmployeeAttendance::where("date", $date)->count();
	}
}