<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    use HasFactory;


    protected $table  ='towns';
    protected $fillable = ['id', 'name','city_id'];


    public function distincts()
    {
       return $this->hasMany(District::class,'town_id');
    }

    public function city()
    {
        return $this->belongsTo(\App\Models\City::class, 'city_id');
    }
}
