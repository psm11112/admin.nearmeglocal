<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index(){
        return Inertia::render('Category/index');
    }

    public function store(Request $request){

        $category=new Category();
        $category->name=$request->name;
        $category->sku=$request->sku;
        $category->description=$request->description;
        $category->save();

    }
}
