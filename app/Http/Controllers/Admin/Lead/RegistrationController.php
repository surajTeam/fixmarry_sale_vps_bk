<?php

namespace App\Http\Controllers\Admin\Lead;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\caste;
use App\Models\Religion;
use App\Models\Lead;
use App\Models\register;
use App\Models\Mothertongue;
use App\Imports\ImportLead;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToArray;
use Illuminate\Support\Facades\Session;

class RegistrationController extends Controller
{
    public function showStepOne() { 
    	$languages = Mothertongue::all();
    	$castes = caste::all();
    	$religions = Religion::all();
    	return view('admin.lead.registration.step_one', compact('languages','castes','religions'));
    }

	public function import(){
		return view('admin.lead.registration.import');
	}
	public function importLeadStore(Request $request) {
		// $this->validate($request, [
        //     'import_file'  => 'required|mimes:xls,xlsx'
        // ]);
		 //dd($request);
		 $import = new ImportLead;
		 Excel::import($import, request()->file('import_file'));
		 if($import->email_old != ''){
			$email_old = $import->email_old;
			$email='';
        	foreach($email_old as $email_list){
				$email .=$email_list. ' ,';
			}
			$str = trim($email, ",");
			// return view('admin.lead.registration.import')->with('success', $email.'This Email are invalid');
			return back()->with('danger', $str.'. This Email are invalid');

		 } else {
			return back()->with('success', 'File Imported Successfully');
		 }
		
        
	}

    
    public function leadStore(Request $request) { 
    	$this->validate($request, [
    		'first_name' => 'required|regex:/^[\pL\s\-]+$/u',
    		'last_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'email_id' => 'required|unique:leads,email',
            'country_code' => 'required',
            'mobile_number' => 'required|size:10|unique:leads,contact_number',
            'gender' => 'required|string',
            'date_of_birth' => 'required|date',
            'marital_status' => 'required',
            'religion' => 'required',
            'caste' => 'required',
            'languages_known' => 'required',
            'residing_country' => 'required',
            'residing_state' => 'required',
            'residing_city' => 'required'
           
            // 'mobile_number' => 'required|size:10|unique:sales_employees,contact_number',
            
        ]);
         $employee = register::create([
        	'firstname' => $request->first_name,
        	'lastname' => $request->last_name,
        	'email' => $request->email_id,
            'mobile_code' => $request->country_code,
        	'mobile' => $request->mobile_number,
        	'gender' => $request->gender,
        	'birthdate' => $request->date_of_birth,
        	'm_status' => $request->marital_status,
        	'tot_children' => $request->no_of_children,
        	'religion' => $request->religion,
        	'caste' => $request->caste,
        	'm_tongue' => $request->languages_known,
        	'country_id' => $request->residing_country,
			'state_id' => $request->residing_state,
        	'city' => $request->residing_city,
        	'address' => $request->address
        	
        	// 'profile_photo_url' => 'https://ui-avatars.com/api/?background=ff7e00&color=fff&name='.$request->name,
        	// 'password' => Hash::make(12345678)
        ]);
         return redirect('admin/lead/register/step-one')->with('success', 'Lead created successfully');
    	
    }
}
