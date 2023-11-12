<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingController extends Controller
{
    public function index(){
        $settings=Setting::where('field','email_verification')->first();


        return Inertia::render('Setting',[
            'settings'=>$settings
        ]);
    }

    public function store(Request $request){

        $setting=Setting::firstOrCreate([
           'field'=>$request->field
        ]);
        $setting->value=$request->value;
        $setting->save();


        return to_route('setting.index')->with('message','Setting Successfully Updated');



    }
}
