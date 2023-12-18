<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends ResponseController
{
    public function index(){

        $category=Category::whereNotNull('parent_id')->paginate(config('service.pagination'));

        return response()->json($category, 200);

    }
}
