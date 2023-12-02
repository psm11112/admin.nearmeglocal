<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{

    public function removeImage($id){
        $gallery=Gallery::FindOrFail($id);

        $id=$gallery->list_id;
        if(\Illuminate\Support\Facades\File::exists(public_path(config('app.image_url').$gallery->url))){
            Storage::disk('public')->delete($gallery->url);
        }

        $gallery->delete();


        return to_route('list'.'.edit',['id'=>$id])->with('message', ' Gallery Image Successfully Deleted');


    }
}
