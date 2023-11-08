<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;
use App\Models\Category;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
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

    public function edit($id){
        $json = \Illuminate\Support\Facades\File::get('flagpack.json');
        $country=Country::find($id);

        return Inertia::render('Country/edit',['flag'=>json_decode($json),'country'=>$country]);
    }

    public function update(CountryRequest $request){




        $country=Country::FindOrFail($request->id);
        $country->name=$request->name;
        $country->slug=Str::slug($request->name);
        $country->svg=$request->svg;
        $country->save();

        return to_route('country.edit',['id'=>$request->id])->with('message','Country successfully Update');

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

        $country = Country::findOrFail($request->id);
        $country->is_active = $request->status[0]['value'];
        $country->save();

        return to_route('country.index')->with('message','Country Status Updated');


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
