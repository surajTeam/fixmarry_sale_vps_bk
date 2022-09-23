<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SalesEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function showDashboard() {
    	$admin = SalesEmployee::select('name', 'profile_photo_url')->where('id', Session::get('sales_employee_id'))->first();
    	return view('admin.dashboard', compact('admin'));
    }
}
