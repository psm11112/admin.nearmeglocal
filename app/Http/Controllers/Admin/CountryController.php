<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;
use App\Models\Country;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CountryController extends Controller
{
    /**
     * @param Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request){

        $country=Country::when($request->term,function($query) use ($request)  {

                    $query->where('name','like','%'.$request->term.'%');
        })->paginate(config('service.pagination'))->withQueryString();
        return Inertia::render('Country/index',[
            'country'=>$country
        ]);
    }

    /**
     * @return \Inertia\Response
     */
    public function create(){
        $json = \Illuminate\Support\Facades\File::get('flagpack.json');

        return Inertia::render('Country/create',['flag'=>json_decode($json)]);
    }

    /**
     * @param CountryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CountryRequest $request){

        $country=new Country();
        $country->name=$request->name;
        $country->slug=Str::slug($request->name);
        $country->svg=$request->svg;
        $country->save();

        return to_route('country.index')->with('message','country successfully added');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeStatus(Request $request)
    {
        $id='';
        $status='';

        foreach ($request->status as $key=>$value){

            if(!is_null($value)){
                $id=$key;
                $status=$value;

            }

        }


        $country= Country::findOrFail($id);
        $country->is_active=$status;
        $country->save();
        return to_route('country.index')->with('message','counter status updated');


    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function itemDeleted(Request $request){

        $country=Country::findOrFail($request->id);

        $country->delete();

        return to_route('country.index')->with('message','Country Successfully Deleted');
    }


}
