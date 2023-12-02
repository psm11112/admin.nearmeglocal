<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListModel extends Model
{
    protected $table='list';

    protected $fillable=['category_id','sub_category_ids'];
    use HasFactory;

    const ITEM_STATUS_SUBMIT= 1;
    const ITEM_STATUS_PUBLISHED = 2;
    const ITEM_STATUS_SUSPENDED=3;

    public function states(){
        return $this->hasOne(State::class,'id','state_id');
    }
    public function city(){
        return $this->hasOne(Cities::class,'id','city_id');
    }
    public function country(){
        return $this->hasOne(Country::class,'id','country_id');
    }

    public function parent_category(){
        return $this->hasOne(Category::class,'id','category_id');
    }
    public function gallery_images(){
        return $this->hasMany(Gallery::class,'list_id','id');
    }
}
