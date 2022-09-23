<?php

namespace App\Http\Controllers;

use App\Models\city;
use App\Models\state;
use Illuminate\Http\Request;

class CityController extends Controller
{
     public function getCities(Request $request) {
        $id = $request->state_id;
         $state_code = state::where('state_id','=',$id)->get();
         // dd($state_code);
        $data = city::where('state_code','=',$state_code[0]->state_code)->get();
        return response()->json($data);
    }

    
}
