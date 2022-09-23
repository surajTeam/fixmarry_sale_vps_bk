<?php

namespace App\Http\Controllers;

use App\Models\state;
use App\Models\Country;
use Illuminate\Http\Request;

class StateController extends Controller
{
    
      public function getStates(Request $request) {
        $id = $request->country_id;
        $county_code = Country::find($id);
        $data = state::where('country_code','=',$county_code->country_code)->get();
        return response()->json($data);
    }
   
}
