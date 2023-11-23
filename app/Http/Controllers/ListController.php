<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ListController extends Controller
{
    public function index(){

        return Inertia::render('List/index');
    }

    public function create(){
        $category=Category::get();

        return Inertia::render('List/create',[
            'category'=>$category
        ]);
    }



}
