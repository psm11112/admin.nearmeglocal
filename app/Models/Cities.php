<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    protected $table='cities';
    use HasFactory;
    protected $fillable=['city_name','state_id','city_slug','city_lat','city_lng','city_image','city_about'];
    public function states(){
        return $this->hasOne(State::class,'id','state_id','is_active');
    }
}
