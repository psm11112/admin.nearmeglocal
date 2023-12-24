<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends ResponseController
{
    public function index(){
        $country=Country::where('is_active',1)->get();

        return response()->json($country->toArray(), 200);

    }
}
