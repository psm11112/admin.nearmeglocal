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


    public function getPrintableCategories()
    {
        $printable_array = array();

        $root_categories = SubCategory::where('parent_id', null)
            ->orderBy('name')
            ->get();

        foreach($root_categories as $key_1 => $root_category)
        {
            $printable_array = array_merge($printable_array, self::getChildrenCategories($root_category));
        }

        return $printable_array;
    }

    private function getChildrenCategories($category, $level_deep=0)
    {
        $dash_str = "";
        for($i=0; $i<$level_deep; $i++)
        {
            $dash_str .= "-";
        }
        if(!empty($dash_str))
        {
            $dash_str .= " ";
        }
        $children_categories_array = array(['category_id' => $category->id, 'category_name' => $dash_str . $category->name]);

        $children_categories = $category->children()->orderBy('name')->get();

        if($children_categories->count() > 0)
        {
            $level_deep += 1;

            foreach($children_categories as $key => $children_category)
            {
                $children_categories_array = array_merge($children_categories_array, self::getChildrenCategories($children_category, $level_deep));
            }
        }

        return $children_categories_array;
    }

}
