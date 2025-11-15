<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProductImage extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['image', 'image200','image50','rank','product_id'];
    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class, 'product_id');
    }

 
}
