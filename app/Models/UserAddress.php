<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class UserAddress extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'user_addresses';
    protected $fillable = ['user_id','city_id','town_id','district_id','neighborhood_id','address','type','name','selected'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function city(){
        return $this->belongsTo(City::class,'city_id');
    }

    public function town(){
        return $this->belongsTo(Town::class,'town_id');
    }


    public function district(){
        return $this->belongsTo(District::class,'district_id');
    }
    public function neighborhood(){
        return $this->belongsTo(Neighborhood::class,'neighborhood_id');
    }
}
