<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'comments';
    protected $fillable = ['user_id','product_id','verified','comment'];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function answers()
    {
       return $this->hasMany(Comment::class,'comment_id');
    }

    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class, 'product_id');
    }

    // public function blog()
    // {
    //     return $this->belongsTo(\App\Models\Blog::class, 'blog_id');
    // }
}
