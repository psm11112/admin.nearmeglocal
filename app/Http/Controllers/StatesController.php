<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatesRequest;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class StatesController extends Controller
{
    public function index(Request $request){
        $states=State::with('country')->when($request->term,function($query) use ($request)  {
            $query->where('name','like','%'.$request->term.'%');
        })->paginate(config('service.pagination'))->withQueryString();
        return Inertia::render('States/index',['states'=>$states]);

    }
    public function create(){
        $country=Country::all();

        return Inertia::render('States/create',[
            'country'=>$country
        ]);
    }
    public function store(StatesRequest $request){


        $stats=new State();
        $stats->name=$request->name;
        $stats->sku=Str::slug($request->name);
        $stats->country_id=$request->country_id;
        $stats->save();
        return to_route('state.index')->with('message','States successfully added');

    }

    public function edit($id){

       $stats=State::FindOrFail($id);
        $country=Country::all();
        return Inertia::render('States/edit',[
            'stats'=>$stats,
            'country'=>$country
        ]);


    }

    public function update(StatesRequest $request){
        $stats=State::FindOrFail($request->id);
        $stats->name=$request->name;
        $stats->sku=Str::slug($request->name);
        $stats->country_id=$request->country_id;
        $stats->save();

        return to_route('state.edit',['id'=>$request->id])->with('message','States successfully Updated');



    }


    public function changeStatus(Request $request)
    {
        $id = '';
        $status = '';


        foreach ($request->status as $key => $value) {

            if (!is_null($value)) {
                $id = $key;
                $status = $value;

            }

        }


        $country = State::findOrFail($id);
        $country->is_active = $status;
        $country->save();
        return to_route('state.index')->with('message', 'State status updated');

    }

    public function itemDeleted(Request $request){

        $country=State::findOrFail($request->id);

        $country->delete();

        return to_route('state.index')->with('message','States Successfully Deleted');
    }
}
