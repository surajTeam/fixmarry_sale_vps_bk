<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryStateCityController extends Controller
{
    public function getCountries() {
        $data = Country::get();
        return response()->json($data);
    }

    //  public function getStates() {
    //     $data = state::get();
    //     return response()->json($data);
    // }

    //  public function getCountries() {
    //     $data = city::get();
    //     return response()->json($data);
    // }
}
