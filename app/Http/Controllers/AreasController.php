<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubCategoryRequest;
use App\Models\Areas;
use App\Models\Cities;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class AreasController extends Controller
{
    protected $modelName='';
    protected $routeName='';
    protected $viewFolderName='';

    public function __construct()
    {
        $this->modelName = 'area';
        $this->routeName='area';
        $this->viewFolderName='Area';


    }

    /**
     * @param Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request){

        $area=Areas::with('city')->when($request->term,function($query) use ($request)  {
            $query->where('name','like','%'.$request->term.'%');
        })->orderBy('id','DESC')->paginate(config('service.pagination'))->withQueryString();



        return Inertia::render($this->viewFolderName.'/index',['area'=>$area]);
    }

    /**
     * @return \Inertia\Response
     */
    public function create(){

        return Inertia::render($this->viewFolderName.'/create');
    }

    /**
     * @param SubCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){

        $this->modelName=new Areas();
        $this->modelName->area_name=$request->name;
        $this->modelName->city_id=$request->city_id;
        $this->modelName->area_slug=$request->slug;

        $this->modelName->save();

        return to_route($this->routeName.'.index')->with('message',$this->routeName.' Successfully Added');

    }

    /**
     * @param $id
     * @return \Inertia\Response
     */
    public function edit($id){
        $this->modelName=Areas::with('city')->FindOrFail($id);
        return Inertia::render($this->viewFolderName.'/edit',[
            'area'=>$this->modelName,
        ]);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request){



        $this->modelName= Areas::FindOrFail($request->id);

        $this->modelName->area_name=$request->name;
        $this->modelName->city_id=$request->city_id;
        $this->modelName->area_slug=$request->slug;

        $this->modelName->save();

        return to_route($this->routeName.'.edit',['id'=>$request->id])->with('message',$this->routeName.' Successfully Updated');


    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeStatus(Request $request)
    {

        $this->modelName = Areas::findOrFail($request->id);
        $this->modelName->is_active = $request->status[0]['value'];
        $this->modelName->save();


        return redirect()->route($this->routeName.'.index', ['page' => $request->page])->with('message',  $this->routeName.' status updated');


       // return to_route($this->routeName.'.index')->with('message',  $this->routeName.' status updated');

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function itemDeleted(Request $request){

        $this->modelName=Areas::findOrFail($request->id);
        $this->modelName->delete();

        return to_route($this->routeName.'.index')->with('message',$this->routeName.' Successfully Deleted');
    }


}
