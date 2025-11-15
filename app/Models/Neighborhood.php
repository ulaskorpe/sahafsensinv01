<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Neighborhood extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name','district_id','postal_code'];

    protected $table = 'neighborhoods';

 
    public function district()
    {
        return $this->belongsTo(\App\Models\Town::class, 'district_id');
    }
}
