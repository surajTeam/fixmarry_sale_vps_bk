<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\SalesEmployee;
use App\Models\SalesRole;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function showEmployeeRegistrationForm() {
    	$sales_employee_roles = SalesRole::where('name', '!=', 'admin')->get();
    	$languages = Language::all();
    	return view('admin.employee.registration_form', compact('languages', 'sales_employee_roles'));
    }

    public function registerEmployee(Request $request) {
    	// return $request->all();
    	$this->validate($request, [
    		'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email|unique:sales_employees',
            'dob' => 'required|date',
            'gender' => 'required|string',
            'address' => 'required|string',
            'employee_role' => 'required',
            'mobile_number' => 'required|size:10|unique:sales_employees,contact_number',
            'languages_known' => 'required|array|min:1'
        ]);

        if(SalesEmployee::count() > 0) {
            $id = SalesEmployee::latest()->first()->id + 1;
        } else {
            $id = 1;
        }

        $fixmarry_employee_id = '';
        switch ($request->employee_role) {
        	case 1:
        		$fixmarry_employee_id = "SAD-".IdGenerator::generate(['table' => 'sales_employees', 'length' => 6, 'prefix' =>date('ymd')]).$id;
        		break;
        	case 2:
        		$fixmarry_employee_id = "STL-".IdGenerator::generate(['table' => 'sales_employees', 'length' => 6, 'prefix' =>date('ymd')]).$id;
        		break;

        	case 3:
        		$fixmarry_employee_id = "TME-".IdGenerator::generate(['table' => 'sales_employees', 'length' => 6, 'prefix' =>date('ymd')]).$id;
        		break;
        }

        $employee = salesEmployee::create([
        	'fixmarry_employee_id' => $fixmarry_employee_id,
        	'name' => $request->name,
        	'role_id' => $request->employee_role,
        	'email' => $request->email,
        	'contact_number' => $request->mobile_number,
        	'gender' => $request->gender,
        	'date_of_birth' => $request->dob,
        	'languages_known' => implode(",", $request['languages_known']),
        	'address' => $request->address,
        	'profile_photo_url' => 'https://ui-avatars.com/api/?background=ff7e00&color=fff&name='.$request->name,
        	'password' => Hash::make(12345678)
        ]);

        if($employee) {
            return redirect(url('admin/employees'))->with('success', 'Employee created');
        }
    }
}
