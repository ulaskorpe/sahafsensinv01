<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PageImage extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['image', 'image200','image50','rank','page_image'];


    public function page()
    {
        return $this->belongsTo(\App\Models\Page::class, 'page_id');
    }
}
