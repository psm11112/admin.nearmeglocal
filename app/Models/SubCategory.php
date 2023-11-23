<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $table='sub_category';
    protected $fillable=['name','sku','category_id','image_url','is_active','parent_id'];

    public function ParentCategory(){
        return $this->hasOne(Category::class,'id','category_id');
    }
    public function children(){
        return $this->hasMany(SubCategory::class,'parent_id')->with('children');
    }
}
