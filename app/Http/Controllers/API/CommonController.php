<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Areas;
use App\Models\Category;
use App\Models\Cities;
use App\Models\Country;
use App\Models\ListModel;
use App\Models\State;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;


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
    public function getSubCategoryByCategory(Request $request){
        $subCategory=Category::where('parent_id',$request->category_id)->get();
        return response()->json($subCategory, 200);
    }
    public function getAllSubCategory(){
        $subCategory=SubCategory::get();
        return response()->json($subCategory, 200);
    }

    public function getCity($id){
        $city=Cities::with('states')->FindOrFail($id);
        return response()->json($city, 200);
    }

    public function getSlug($name){
        $slug=Str::slug($name);
        return response()->json($slug);

    }
    public function getAllStates(){
        $states=State::get();
        return response()->json($states, 200);
    }
    public function getAllCity(){
        $city=Cities::get();
        return response()->json($city, 200);

    }
    public function getArea($id){
        $area=Areas::with('city')->FindOrFail($id);
        return response()->json($area, 200);
    }

    public function getStatsByCountryId($country_id){

        $stats=State::where('country_id',$country_id)->get();

        return response()->json($stats, 200);

    }

    public function getCityByStatsId($stats_id){
        $city=Cities::where('state_id',$stats_id)->get();

        return response()->json($city, 200);

    }

    public function getAreaByCityId($city_id){
        $area=Areas::where('city_id',$city_id)->get();
        return response()->json($area, 200);

    }

    public function upload(Request $request){
        $imageList=[];

        if($request->hasFile('demo')){
            $demoImage = $request->demo->store('image/temp', 'public');
            return $demoImage;
        }

        if ($request->hasFile('gallery')) {
            foreach ($request->gallery as $image){
                $bannerImage = $image->store('image/temp', 'public');
                array_push($imageList,$bannerImage);
            }
            return $bannerImage;
        }
    }

    public function getList($id){
        $list=ListModel::with('gallery_images')->FindOrFail($id);
        return response()->json($list, 200);
    }

    public function getEncryptString($id){
       $token= Crypt::encryptString($id);
        return response()->json($token, 200);

    }



}
