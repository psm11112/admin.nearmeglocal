<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\StatesRequest;
use App\Models\Category;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CategoryController extends Controller
{

    protected $modelName='';
    protected $routeName='';

    public function __construct()
    {
        $this->modelName = 'category';
        $this->routeName='category';

    }
    public function index(Request $request){



        $category=Category::when($request->term,function($query) use ($request)  {
            $query->where('name','like','%'.$request->term.'%');
        })->paginate(config('service.pagination'))->withQueryString();

        foreach ($category as $item){
            if(!is_null($item->parent_id))
            {
                $ty=Category::find($item->parent_id);
                $item['parent_name']=$ty->name;
            }


        }




        return Inertia::render('Category/index',['category'=>$category]);
    }
    public function create(){


        $printable_categories = new Category();
        $printable_categories = $printable_categories->getPrintableCategories();

        return Inertia::render('Category/create',['parent_category'=>$printable_categories]);
    }

    public function store(CategoryRequest $request){


        $image_path=null;

        if ($request->hasFile('photo')) {

            $image_path = $request->file('photo')->store('image', 'public');
        }

        $this->modelName=new Category();
        $this->modelName->name=$request->name;
        $this->modelName->sku=$request->sku;
        $this->modelName->description=$request->description;
        $this->modelName->image_url=$image_path;
        $this->modelName->parent_id=$request->parent_id;
        $this->modelName->save();

        return to_route($this->routeName.'.index')->with('message',$this->routeName.' Successfully Added');

    }

    public function edit($id){


        $this->modelName=Category::FindOrFail($id);
//        $country=Country::all();

        $printable_categories = new Category();
        $printable_categories = $printable_categories->getPrintableCategories();

        return Inertia::render('Category/edit',[
            'category'=>$this->modelName,
            'parent_category' =>$printable_categories


        ]);


    }

    public function update(CategoryRequest $request){



        $image_path=null;
        $this->modelName= Category::FindOrFail($request->id);

        if ($request->hasFile('photo')) {

            if(!is_null($this->modelName->image_url)){
                Storage::disk('public')->delete($this->modelName->image_url);
            }

            $image_path = $request->file('photo')->store('image', 'public');
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

        $this->modelName->name=$request->name;
        $this->modelName->sku=$request->sku;
        $this->modelName->description=$request->description;
        $this->modelName->parent_id=$request->parent_id;


        $this->modelName->image_url=$imageUrl;

        $this->modelName->save();

        return to_route($this->routeName.'.edit',['id'=>$request->id])->with('message',$this->routeName.' Successfully Added');


    }


    public function changeStatus(Request $request)
    {

        $this->modelName = Category::findOrFail($request->id);
        $this->modelName->is_active = $request->status[0]['value'];
        $this->modelName->save();
        return to_route($this->routeName.'.index')->with('message',  $this->routeName.' status updated');


    }

    public function itemDeleted(Request $request){

        $this->modelName=Category::findOrFail($request->id);

        if(!is_null($this->modelName->image_url)){
            Storage::disk('public')->delete($this->modelName->image_url);
        }

        $this->modelName->delete();

        return to_route($this->routeName.'.index')->with('message',$this->routeName.' Successfully Deleted');
    }

    public function deleteImage(Request $request){

        Storage::disk('public')->delete($request->photo);
        $this->modelName=Category::findOrFail($request->id);
        $this->modelName->image_url=null;
        $this->modelName->save();

        return to_route($this->routeName.'.edit',['id'=>$request->id])->with('message',$this->routeName.' Images Removed');

    }


}
