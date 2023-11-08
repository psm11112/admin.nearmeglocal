<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;

class CommonController extends ResponseController
{
    public function getUser($id){
        $user=User::FindOrFail($id);

        return response()->json($user, 200);

    }

    public function  getCountry($id){
        $country=Country::FindOrFail($id);
        return response()->json($country, 200);
    }

    public function  getStates($id){
        $state=State::with('country')->FindOrFail($id);
        return response()->json($state, 200);
    }
}
