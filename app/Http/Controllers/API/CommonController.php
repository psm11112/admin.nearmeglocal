<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Country;
use App\Models\State;
use App\Models\SubCategory;
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
    public function  getCategory($id){
        $category=Category::FindOrFail($id);
        return response()->json($category, 200);
    }
    public function  getSubCategory($id){
        $subCategory=SubCategory::with('ParentCategory')->FindOrFail($id);
        return response()->json($subCategory, 200);
    }
}
