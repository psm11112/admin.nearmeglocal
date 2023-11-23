<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\SubCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class SubCategoryController extends Controller
{
    protected $modelName='';
    protected $routeName='';

    public function __construct()
    {
        $this->modelName = 'subCategory';
        $this->routeName='sub-category';

    }
    public function index(Request $request){
        $category=SubCategory::whereNull('parent_id')->with(['children','ParentCategory'])->when($request->term,function($query) use ($request)  {
            $query->where('name','like','%'.$request->term.'%');
        })->paginate(config('service.pagination'))->withQueryString();



        return Inertia::render('SubCategory/index',['subCategory'=>$category]);
    }
    public function create(){
        $category=Category::select('id','name')->get();

        return Inertia::render('SubCategory/create',['category'=>$category]);
    }

    public function store(SubCategoryRequest $request){

        $image_path=null;

            if ($request->hasFile('photo')) {

            $image_path = $request->file('photo')->store('image/sub-category', 'public');
        }

        $this->modelName=new SubCategory();
        $this->modelName->name=$request->name;
        $this->modelName->category_id=$request->category_id;
        $this->modelName->sku=$request->sku;
        $this->modelName->image_url=$image_path;
        $this->modelName->save();

        foreach ($request->child_category_id as $childCategory ){
            $ch=SubCategory::find($childCategory['id']);
            $ch->parent_id=$this->modelName->id;
            $ch->save();

        }

        return to_route($this->routeName.'.index')->with('message',$this->routeName.' Successfully Added');

    }

    public function edit($id){



        $this->modelName=SubCategory::with(['children','ParentCategory'])->FindOrFail($id);
        $category=Category::select('id','name')->get();

        return Inertia::render('SubCategory/edit',[
            'subCategory'=>$this->modelName,
            'category'=>$category

        ]);


    }

    public function update(Request $request){

        $this->modelName= SubCategory::FindOrFail($request->id);

        $image_path=null;

        if ($request->hasFile('photo')) {

            if(!is_null($this->modelName->image_url)){
                Storage::disk('public')->delete($this->modelName->image_url);
            }

            $image_path = $request->file('photo')->store('image/sub-category', 'public');
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

        $this->modelName= SubCategory::FindOrFail($request->id);
        $this->modelName->category_id =$request->category_id;
        $this->modelName->name=$request->name;
        $this->modelName->sku=$request->sku;
       // $this->modelName->description=$request->description;

        $this->modelName->image_url=$imageUrl;

        $this->modelName->save();



        return to_route($this->routeName.'.edit',['id'=>$request->id])->with('message',$this->routeName.' Successfully Updated');


    }


    public function changeStatus(Request $request)
    {

        $this->modelName = SubCategory::findOrFail($request->id);
        $this->modelName->is_active = $request->status[0]['value'];
        $this->modelName->save();
        return to_route($this->routeName.'.index')->with('message',  $this->routeName.' status updated');


    }

    public function itemDeleted(Request $request){

        $this->modelName=SubCategory::findOrFail($request->id);

        if(!is_null($this->modelName->image_url)){
            Storage::disk('public')->delete($this->modelName->image_url);
        }

        $this->modelName->delete();

        return to_route($this->routeName.'.index')->with('message',$this->routeName.' Successfully Deleted');
    }

    public function deleteImage(Request $request){

        Storage::disk('public')->delete($request->photo);
        $this->modelName=SubCategory::findOrFail($request->id);
        $this->modelName->image_url=null;
        $this->modelName->save();

        return to_route($this->routeName.'.edit',['id'=>$request->id])->with('message',$this->routeName.' Images Removed');

    }

    public function addSubCategory(Request $request){

         $this->modelName=SubCategory::find($request->category_id);
         $this->modelName->parent_id=$request->parent_id;
         $this->modelName->save();

        return to_route($this->routeName.'.index')->with('message',$this->routeName.' Successfully Deleted');

       // dd($request->all());
    }

    public function removeSubCategoryFromParent(Request $request){
        $this->modelName=SubCategory::find($request->id);
        $this->modelName->parent_id=null;
        $this->modelName->save();

        return to_route($this->routeName.'.index')->with('message',$this->routeName.' Successfully Removed');

    }

}
