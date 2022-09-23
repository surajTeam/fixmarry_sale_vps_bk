<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SalesEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLoginPage() {
        if(Session::has('sales_employee_id')) {
            return redirect('/');
        } else {
            return view('auth.login_form');
        }
    	
    }

    public function employeeLogin(Request $request) {
    	$this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|string|min:8'
        ]);

        $employee = SalesEmployee::where('email', $request->email)->first();

        if($employee != NULL) {
        	if (Hash::check($request->password, $employee->password)) {
        		
        		Session::put('sales_employee_id', $employee->id);
        		Session::put('sales_employee_role_id', $employee->role_id);
        		return redirect('/');
        		
    		} else {
    			return redirect()->back()->withInput()->withErrors(['password' => "Password is wrong"]);
    		}
        } else {
        	return redirect()->back()->withInput()->withErrors(['email' => "The user doesn't exist"]);
        }
    }
}
