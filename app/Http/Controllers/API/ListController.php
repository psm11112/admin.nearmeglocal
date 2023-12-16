<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ListModel;
use Illuminate\Http\Request;

class ListController extends ResponseController
{
    public function index(){
        $list=ListModel::with('parent_category')->where('item_featured',1)->where('item_status',2)->paginate(config('service.pagination'));

        return response()->json($list, 200);

    }
}