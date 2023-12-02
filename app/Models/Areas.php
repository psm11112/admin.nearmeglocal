<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Areas extends Model
{
    protected $table='areas';
    use HasFactory;
    protected $fillable=['city_id','area_name','area_slug','is_active'];

    public function city(){
        return $this->hasOne(Cities::class,'id','city_id');
    }
}
