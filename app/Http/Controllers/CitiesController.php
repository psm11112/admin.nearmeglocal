<?php

namespace App\Http\Controllers;

use App\Http\Requests\CitiesRequest;
use App\Http\Requests\SubCategoryRequest;
use App\Models\Cities;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class CitiesController extends Controller
{
    protected $modelName='';
    protected $routeName='';

    public function __construct()
    {
        $this->modelName = 'cities';
        $this->routeName='cities';

    }

    /**
     * @param Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request){
        $cities=Cities::with('states')->when($request->term,function($query) use ($request)  {
            $query->where('city_name','like','%'.$request->term.'%');
        })->orderBy('id','DESC')->paginate(config('service.pagination'))->withQueryString();


        return Inertia::render('Cities/index',['cities'=>$cities]);
    }

    /**
     * @return \Inertia\Response
     */
    public function create(){

        return Inertia::render('Cities/create');
    }

    /**
     * @param SubCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CitiesRequest $request){
        $image_path=null;

        if ($request->hasFile('photo')) {

            $image_path = $request->file('photo')->store('image/cities', 'public');
        }

        $this->modelName=new Cities();
        $this->modelName->city_name=$request->name;
        $this->modelName->state_id =$request->state;
        $this->modelName->city_slug=$request->slug;
        $this->modelName->city_image=$image_path;
        $this->modelName->city_about=$request->about;

        $this->modelName->save();

        return to_route($this->routeName.'.index')->with('message',$this->routeName.' Successfully Added');

    }

    /**
     * @param $id
     * @return \Inertia\Response
     */
    public function edit($id){
        $this->modelName=Cities::with('states')->FindOrFail($id);
        return Inertia::render('Cities/edit',[
            'cities'=>$this->modelName,
        ]);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request){

        $this->modelName= Cities::FindOrFail($request->id);
        $image_path=null;
        if ($request->hasFile('photo')) {

            if(!is_null($this->modelName->city_image)){
                Storage::disk('public')->delete($this->modelName->city_image);
            }

            $image_path = $request->file('photo')->store('image/cities', 'public');
        }

        if(!is_null($image_path)){
            $imageUrl=$image_path;
        }else{
            if(!is_null($this->modelName->image_url)){
                $imageUrl=$this->modelName->image_url;
            }else{
                $imageUrl=null;
            }
        }

        $this->modelName= Cities::FindOrFail($request->id);
        $this->modelName->state_id =$request->state;
        $this->modelName->city_name=$request->name;
        $this->modelName->city_slug=$request->slug;
        $this->modelName->city_about=$request->about;

        $this->modelName->city_image=$imageUrl;
        $this->modelName->save();

        return to_route($this->routeName.'.edit',['id'=>$request->id])->with('message',$this->routeName.' Successfully Updated');


    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeStatus(Request $request)
    {

        $this->modelName = Cities::findOrFail($request->id);
        $this->modelName->is_active = $request->status[0]['value'];
        $this->modelName->save();
        return to_route($this->routeName.'.index')->with('message',  $this->routeName.' status updated');


    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function itemDeleted(Request $request){

        $this->modelName=Cities::findOrFail($request->id);

        if(!is_null($this->modelName->image_url)){
            Storage::disk('public')->delete($this->modelName->image_url);
        }

        $this->modelName->delete();

        return to_route($this->routeName.'.index')->with('message',$this->routeName.' Successfully Deleted');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteImage(Request $request){


        Storage::disk('public')->delete($request->old_image);
        $this->modelName=Cities::findOrFail($request->id);
        $this->modelName->city_image=null;
        $this->modelName->save();

        return to_route($this->routeName.'.edit',['id'=>$request->id])->with('message',$this->routeName.' Images Removed');

    }



}
