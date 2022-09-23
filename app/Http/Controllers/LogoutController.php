<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    public function logout(Request $request) {
    	
    	if(Session::has('sales_employee_id')) {
    		Session::flush();
    		return redirect()->back();
    	}
    	return redirect()->back();
    }
}
