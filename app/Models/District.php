<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name','town_id'];

    protected $table = 'districts';

    public function neigborhoods()
    {
       return $this->hasMany(Neighborhood::class,'district_id');
    }

    public function town()
    {
        return $this->belongsTo(\App\Models\Town::class, 'town_id');
    }
}
