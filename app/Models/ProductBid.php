<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductBid extends Model
{
    use HasFactory,SoftDeletes;

    protected $table= 'product_bids';
    protected $fillable = ['user_id','product_id','bid_price'];


    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(\App\Models\User::class, 'product_id');
    }
}
